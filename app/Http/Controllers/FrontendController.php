<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderdetail;
use Auth;
use Illuminate\Pagination\Paginator;

class FrontendController extends Controller
{
    public function welcome()
    {
    	$brand=Brand::orderBy('brandname', 'ASC')->get();
    	$category=Category::orderBy('categoryname', 'ASC')->get();
    	$product=Product::where('newly', '1')->get();
        $product2=Product::orderBy('sales', 'DESC')->take(100)->get();
        return view('welcome', compact('brand', 'category', 'product', 'product2'));
    }

    public function searchresult(Request $request)
    {
        Paginator::useBootstrap();
        $search_product=$request->input('product');
        $brand_id=Brand::where('brandname', 'like', '%' . $search_product . '%')->pluck('id');
        $category_id=Category::where('categoryname', 'like', '%' . $search_product . '%')->pluck('id');
        if (isset($search_product) && !$brand_id->isEmpty()) {
            $product=Product::where('brand_id', $brand_id)->orWhere('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->paginate(12);
            $product_all=Product::where('brand_id', $brand_id)->orWhere('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->get();
            $product->appends(['product' => $search_product]);
            $brand=Brand::orderBy('brandname', 'ASC')->get();
            return view('searchproduct', compact('product', 'brand', 'search_product', 'product_all'));
        }
        elseif (isset($search_product) && !$category_id->isEmpty()) {
            $product=Product::where('category_id', $category_id)->orWhere('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->paginate(12);
            $product_all=Product::where('category_id', $category_id)->orWhere('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->get();
            $product->appends(['product' => $search_product]);
            $brand=Brand::orderBy('brandname', 'ASC')->get();
            return view('searchproduct', compact('product', 'brand', 'search_product', 'product_all'));
        }
        elseif(isset($search_product)) {
            $product=Product::where('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->paginate(12);
            $product_all=Product::where('productname', 'like', '%' . $search_product . '%')->orWhere('productmodel', 'like', '%' . $search_product . '%')->orderBy('productname', 'ASC')->get();
            $product->appends(['product' => $search_product]);
            $brand=Brand::orderBy('brandname', 'ASC')->get();
            return view('searchproduct', compact('product', 'brand', 'search_product', 'product_all'));
        }
        else{
            $notification = array(
                'message' => 'Please insert a keyword',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function addtowishlist($id){
        $wishlist = new Wishlist;
        $wishlist->product_id=$id;
        $wishlist->user_id=Auth::user()->id;
        $wishlist->save();

        $notification = array(
            'message' => 'Successfully added to wishlist',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function showwishlist(){
        Paginator::useBootstrap();
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $user_id=Auth::user()->id;
        $product_id=Wishlist::where('user_id', $user_id)->pluck('product_id');
        $product=Product::whereIn('id', $product_id)->paginate(12);
        $product_all=Product::whereIn('id', $product_id)->get();
        return view('wishlist', compact('brand', 'product', 'product_all'));
    }

    public function removefromwishlist($id)
    {
        $user_id=Auth::user()->id;
        $wishlist=Wishlist::where('product_id', $id)->where('user_id', $user_id);
        $wishlist->delete();

        $notification = array(
            'message' => 'Successfully removed from wishlist',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function categorywiseproduct($id){
        Paginator::useBootstrap();
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $category=Category::findorfail($id);
        $product=Product::where('category_id', $id)->paginate(12);
        $product_all=Product::where('category_id', $id)->get();
        return view('category_wise', compact('brand', 'category', 'product', 'product_all'));
    }

    public function brandwiseproduct($id){
        Paginator::useBootstrap();
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $brand2=Brand::findorfail($id);
        $product=Product::where('brand_id', $id)->paginate(12);
        $product_all=Product::where('brand_id', $id)->get();
        return view('brand_wise', compact('brand', 'brand2', 'product', 'product_all'));
    }

    public function productdetail($id){
        Paginator::useBootstrap();
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $product=Product::findorfail($id);
        $review=Review::where('product_id', $id)->orderBy('id', 'ASC')->paginate(3);
        return view('product_detail', compact('brand', 'product', 'review'));
    }

    public function addtocart(Request $request, $id){
        $validatedData = $request->validate([
            'color' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255'],
        ]);

        $quantity=$request->quantity;
        $product=Product::where('id', $id)->value('productquantity');
        if ($quantity > $product) {
            $notification = array(
                'message' => 'Yoyr requested quantity is not available',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        elseif($quantity <= $product){
            $user_id=Auth::user()->id;
            $cart_already=Cart::where('product_id', $id)->where('user_id', $user_id)->get();
            if (count($cart_already) > 0) {
                $notification = array(
                    'message' => 'Already added to cart',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
            else{
                $cart = new Cart;
                $cart->color=$request->color;
                $cart->quantity=$request->quantity;
                $cart->product_id=$id;
                $cart->user_id=Auth::user()->id;
                $cart->save();

                $notification = array(
                    'message' => 'Successfully added to cart',
                    'alert-type' => 'success'
                );
                return Redirect()->back()->with($notification);
            }
        }
    }

    public function removefromcart($id)
    {
        $user_id=Auth::user()->id;
        $cart=Cart::where('product_id', $id)->where('user_id', $user_id);
        $cart->delete();

        $notification = array(
            'message' => 'Successfully removed from cart',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function viewcart(){
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        return view('view_cart', compact('brand'));
    }

    public function updatecart(Request $request, $id){
        $validatedData = $request->validate([
            'quantity' => ['required', 'string', 'max:255'],
        ]);

        $cart_quantity=Cart::where('id', $id)->value('quantity');
        $quantity=$request->quantity;
        if ($cart_quantity == $quantity) {
            $notification = array(
                'message' => 'You have not updated the quantity',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $cart=Cart::findorfail($id);
            $cart->quantity=$quantity;
            $cart->save();

            $notification = array(
                'message' => 'Cart successfully updated',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function ordercheckout(){
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $user_id = Auth::user()->id;
        $carts=Cart::where('user_id', $user_id)->get();
        $subtotal = array();
        foreach ($carts as $cart) {
            $quantity = $cart->quantity;
            $price = $cart->products->discountedprice;
            $new_price = $quantity * $price;
            array_push($subtotal, $new_price);
        }
        $total = array_sum($subtotal);
        return view('order_checkout', compact('brand', 'total'));
    }

    public function buyerprocessingorder(){
        $user_id = Auth::user()->id;
        $order_id=Order::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('order_id', $order_id)->get();
        return view('user.order.processing_order', compact('orderdetail'));
    }

    public function buyercompletedorder(){
        $user_id = Auth::user()->id;
        $order_id=Order::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('order_id', $order_id)->get();
        return view('user.order.completed_order', compact('orderdetail'));
    }

    public function buyercanceledorder(){
        $user_id = Auth::user()->id;
        $order_id=Order::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('order_id', $order_id)->get();
        return view('user.order.canceled_order', compact('orderdetail'));
    }

    public function buyervieworder($id){
        $orderdetail=Orderdetail::findorfail($id);
        return view('user.order.view_order', compact('orderdetail'));
    }

    public function cancelorder($id){
        $orderdetail=Orderdetail::findorfail($id);
        if ($orderdetail->status == 'Shipped') {
            $notification = array(
                'message' => 'Sorry, this product has already shipped',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $orderdetail->status = 'Canceled';
            $orderdetail->save();

            $notification = array(
                'message' => 'Order successfully canceled',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function submitreview(Request $request, $id){
        $sub_review = $request->review;
        $sub_rating = $request->rating;
        if (isset($sub_review) && isset($sub_rating)) {
            $orderdetail=Orderdetail::findorfail($id);
            $review = new Review;
            $review->rating = $sub_rating;
            $review->comment = $sub_review;
            $review->user_id = Auth::user()->id;
            $review->product_id = $orderdetail->product_id;
            $review->orderdetail_id = $id;
            $review->save();
            $notification = array(
                'message' => 'Review successfully submitted',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
        elseif(isset($sub_review)){
            $notification = array(
                'message' => 'Your rating is required',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        elseif(isset($sub_rating)){
            $notification = array(
                'message' => 'Your review is required',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Your review and rating both are required',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
