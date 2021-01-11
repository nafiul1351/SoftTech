<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Auth;

class SslCommerzPaymentController extends Controller
{
    public function index(Request $request, $total)
    {
        $payment=$request->payment;
        if (isset($payment) && $payment == 'OP') {
            $validatedData = $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'shippingaddress' => ['required', 'string', 'max:255'],
                'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255'],
                'note' => ['nullable', 'string', 'max:255'],
            ]);

            $order = Order::create([
                'trx_id' => 'order-'.time(),
                'total' => $total,
                'type' => $request['payment'],
                'status' => 'Pending',
                'note' => $request['note'],
                'currency' => 'BDT',
                'user_id' => Auth::user()->id,
            ]);

            $user_id = Auth::user()->id;
            $carts=Cart::where('user_id', $user_id)->get();
            foreach ($carts as $cart) {
                $quantity = $cart->quantity;
                $price = $cart->products->discountedprice;
                $total2 = $quantity * $price;
                $orderdetail = Orderdetail::create([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'shippingaddress' => $request['shippingaddress'],
                    'phonenumber' => $request['phonenumber'],
                    'color' => $cart->color,
                    'quantity' => $quantity,
                    'total' => $total2,
                    'status' => 'Pending',
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                ]);
            }

            $fullname = $request->firstname.' '.$request->lastname;

            $post_data = array();
            $post_data['total_amount'] = $order->total;
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = $order->trx_id;

            $post_data['cus_name'] = $fullname;
            $post_data['cus_email'] = $request->email;
            $post_data['cus_add1'] = $request->shippingaddress;
            $post_data['cus_add2'] = $request->shippingaddress;
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $request->phonenumber;
            $post_data['cus_fax'] = "";

            $post_data['ship_name'] = $fullname;
            $post_data['ship_add1'] = $request->shippingaddress;
            $post_data['ship_add2'] = $request->shippingaddress;
            $post_data['ship_city'] = "";
            $post_data['ship_state'] = "";
            $post_data['ship_postcode'] = "";
            $post_data['ship_phone'] = $request->phonenumber;
            $post_data['ship_country'] = "Bangladesh";

            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = $order->orderdetails[0]->products->productname;
            $post_data['product_category'] = $order->orderdetails[0]->products->categories->categoryname;
            $post_data['product_profile'] = $order->orderdetails[0]->products->productmodel;

            $post_data['value_a'] = "ref001";
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";

            $sslc = new SslCommerzNotification();

            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        }
        elseif(isset($payment) && $payment == 'COD'){
            $validatedData = $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'shippingaddress' => ['required', 'string', 'max:255'],
                'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255'],
                'note' => ['nullable', 'string', 'max:255'],
            ]);

            $order = Order::create([
                'trx_id' => 'order-'.time(),
                'total' => $total,
                'type' => $request['payment'],
                'status' => 'Processing',
                'note' => $request['note'],
                'currency' => 'BDT',
                'user_id' => Auth::user()->id,
            ]);

            $user_id = Auth::user()->id;
            $carts=Cart::where('user_id', $user_id)->get();
            foreach ($carts as $cart) {
                $quantity = $cart->quantity;
                $price = $cart->products->discountedprice;
                $total2 = $quantity * $price;
                $orderdetail = Orderdetail::create([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'shippingaddress' => $request['shippingaddress'],
                    'phonenumber' => $request['phonenumber'],
                    'color' => $cart->color,
                    'quantity' => $quantity,
                    'total' => $total2,
                    'status' => 'Processing',
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                ]);
                $product_id=$cart->product_id;
                $product=Product::findorfail($product_id);
                $quantity2=$product->productquantity;
                $quantity3=$quantity2 - $quantity;
                $product->productquantity=$quantity3;
                $product->sales=$quantity;
                $product->save();

                $cart->delete();
            }

            $notification = array(
                'message' => 'Order is successfully placed',
                'alert-type' => 'success'
            );
            return redirect()->route('buyer.processing.order')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Please select a payment method',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        $order_detials = Order::select('id', 'trx_id', 'total', 'status', 'currency', 'user_id')->where('trx_id', $tran_id)->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());
            if ($validation == TRUE) {
                $update_product = Order::where('trx_id', $tran_id)->update(['status' => 'Processing']);
                $order_id=$order_detials->id;
                $update_details = Orderdetail::where('order_id', $order_id)->update(['status' => 'Processing']);
                $user_id=$order_detials->user_id;
                $carts=Cart::where('user_id', $user_id)->get();
                foreach ($carts as $cart) {
                    $quantity=$cart->quantity;
                    $product_id=$cart->product_id;
                    $product=Product::findorfail($product_id);
                    $quantity2=$product->productquantity;
                    $quantity3=$quantity2 - $quantity;
                    $product->productquantity=$quantity3;
                    $product->sales=$quantity;
                    $product->save();

                    $cart->delete();
                }

                $notification = array(
                    'message' => 'Transaction is successful',
                    'alert-type' => 'success'
                );
                return redirect()->route('buyer.processing.order')->with($notification);
            } else {
                $order_id=$order_detials->id;
                $order_detail = Orderdetail::where('order_id', $order_id)->delete();
                $order_detials->delete();
                    
                $notification = array(
                    'message' => 'Transaction is failed',
                    'alert-type' => 'error'
                );
                return redirect()->route('order.checkout')->with($notification);
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $notification = array(
                'message' => 'Transaction is already successful',
                'alert-type' => 'success'
            );
            return redirect()->route('buyer.processing.order')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->route('order.checkout')->with($notification);
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = Order::select('id', 'trx_id', 'total', 'status', 'currency')->where('trx_id', $tran_id)->first();

        if ($order_detials->status == 'Pending') {
            $order_id=$order_detials->id;
            $order_detail = Orderdetail::where('order_id', $order_id)->delete();
            $order_detials->delete();
                    
            $notification = array(
                'message' => 'Transaction is failed',
                'alert-type' => 'error'
            );
            return redirect()->route('order.checkout')->with($notification);
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $notification = array(
                'message' => 'Transaction is already successful',
                'alert-type' => 'success'
            );
            return redirect()->route('buyer.processing.order')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->route('order.checkout')->with($notification);
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = Order::select('id', 'trx_id', 'total', 'status', 'currency')->where('trx_id', $tran_id)->first();

        if ($order_detials->status == 'Pending') {
            $order_id=$order_detials->id;
            $order_detail = Orderdetail::where('order_id', $order_id)->delete();
            $order_detials->delete();
                    
            $notification = array(
                'message' => 'Transaction is canceled',
                'alert-type' => 'error'
            );
            return redirect()->route('order.checkout')->with($notification);
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $notification = array(
                'message' => 'Transaction is already successful',
                'alert-type' => 'success'
            );
            return redirect()->route('buyer.processing.order')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->route('order.checkout')->with($notification);
        }
    }

    public function ipn(Request $request)
    {
        if ($request->input('tran_id'))
        {

            $tran_id = $request->input('tran_id');

            $order_details = Order::select('id', 'trx_id', 'total', 'status', 'currency', 'user_id')->where('trx_id', $tran_id)->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    $update_product = Order::where('trx_id', $tran_id)->update(['status' => 'Processing']);
                    $order_id=$order_detials->id;
                    $update_details = Orderdetail::where('order_id', $order_id)->update(['status' => 'Processing']);
                    $user_id=$order_detials->user_id;
                    $cart=Cart::where('user_id', $user_id)->delete();

                    $notification = array(
                        'message' => 'Transaction is successful',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('buyer.processing.order')->with($notification);
                } else {
                    $order_id=$order_detials->id;
                    $order_detail = Orderdetail::where('order_id', $order_id)->delete();
                    $order_detials->delete();
                    
                    $notification = array(
                        'message' => 'Transaction is failed',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('order.checkout')->with($notification);
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
                $notification = array(
                    'message' => 'Transaction is already successful',
                    'alert-type' => 'success'
                );
                return redirect()->route('buyer.processing.order')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Something went wrong',
                    'alert-type' => 'error'
                );
                return redirect()->route('order.checkout')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
            return redirect()->route('order.checkout')->with($notification);
        }
    }

}
