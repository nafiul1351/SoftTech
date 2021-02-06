<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Otherimage;
use App\Models\Orderdetail;
use Image;
use Auth;

class SellerController extends Controller
{
    public function addshop()
    {
        return view('seller.shop.add_shop');
    }

    public function storeshop(Request $request){
        $validatedData = $request->validate([
            'serialnumber' => ['required', 'string', 'max:255', 'unique:shops'],
            'shopname' => ['required', 'string', 'max:255'],
        ]);

        $shop=Shop::where('user_id', Auth::user()->id)->get();
        if (count($shop) < 2) {
        	$shop = new Shop;
	        $shop->serialnumber=$request->serialnumber;
	        $shop->shopname=$request->shopname;
	        $shop->user_id=Auth::user()->id;
	        $shop->save();

	        $notification = array(
	            'message' => 'Shop successfully added',
	            'alert-type' => 'success'
	        );
	        return Redirect()->back()->with($notification);
        }
        else{
        	$notification = array(
	            'message' => 'Only 2 shops can be added',
	            'alert-type' => 'error'
	        );
	        return Redirect()->back()->with($notification);
        }
    }

    public function allshop()
    {
        $shop=Shop::where('user_id', Auth::user()->id)->get();
        return view('seller.shop.all_shop', compact('shop'));
    }

    public function editshop($id){
        $shop = Shop::findorfail($id);
        return view('seller.shop.edit_shop', compact('shop'));
    }

    public function updateshop(Request $request, $id){
        $validatedData = $request->validate([
            'serialnumber' => ['required', 'string', 'max:255'],
            'shopname' => ['required', 'string', 'max:255'],
        ]);

        $shop = Shop::findorfail($id);
        $shop->serialnumber=$request->serialnumber;
        $shop->shopname=$request->shopname;
        $shop->save();

        $notification = array(
            'message' => 'Shop successfully updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.shop')->with($notification);
    }

    public function deleteshop($id){
        $shop=Shop::findorfail($id);
        $shop->delete();

        $notification = array(
            'message' => 'Shop successfully deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function addproduct()
    {
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $category=Category::orderBy('categoryname', 'ASC')->get();
        $shop=Shop::where('user_id', Auth::user()->id)->orderBy('shopname', 'ASC')->get();
        return view('seller.product.add_product', compact('brand', 'category', 'shop'));
    }

    public function storeproduct(Request $request){
        $validatedData = $request->validate([
            'productid' => ['required', 'string', 'max:255', 'unique:products'],
            'productname' => ['required', 'string', 'max:255'],
            'productmodel' => ['required', 'string', 'max:255'],
            'brand' => ['required'],
            'category' => ['required'],
            'productcolor' => ['required', 'string', 'max:255'],
            'shop' => ['required'],
            'coverimage' => ['required', 'image', 'max:2048'],
            'otherimages' => ['required'],
            'otherimages.*' => ['image', 'max:2048'],
            'regularprice' => ['required', 'string', 'max:255'],
            'discountedprice' => ['required', 'string', 'max:255'],
            'newly' => ['required', 'string'],
            'productquantity' => ['required', 'string', 'max:255'],
            'productdescription' => ['required', 'string', 'max:1500'],
        ]);

        $product = new Product;
        $product->productid=$request->productid;
        $product->productname=$request->productname;
        $product->productmodel=$request->productmodel;
        $product->productcolor=$request->productcolor;
        $image = $request->file('coverimage');
        $name = hexdec(uniqid());
        $extension = $image->getClientOriginalExtension();
        $fullname = $name.'.'.$extension;
        $path = 'public/images/products/images/';
        $url = $path.$fullname;
        $resize_image=Image::make($image->getRealPath());
        $resize_image->resize(500,500);
        $resize_image->save('public/images/products/images/'.$fullname);
        $product->coverimage = $url;
        $product->productdescription=$request->productdescription;
        $product->regularprice=$request->regularprice;
        $product->discountedprice=$request->discountedprice;
        $product->newly=$request->newly;
        $product->productquantity=$request->productquantity;
        $product->user_id=Auth::user()->id;
        $product->brand_id=$request->brand;
        $product->category_id=$request->category;
        $product->shop_id=$request->shop;
        $product->save();
        $images = $request->file('otherimages');
        foreach ($images as $img) {
            $name = hexdec(uniqid());
            $extension = $img->getClientOriginalExtension();
            $fullname = $name.'.'.$extension;
            $path = 'public/images/products/images/otherimages/';
            $url = $path.$fullname;
            $resize_image=Image::make($img->getRealPath());
            $resize_image->resize(500,500);
            $resize_image->save('public/images/products/images/otherimages/'.$fullname);
            Otherimage::create([
                'otherimage' => $url,
                'product_id' => $product->id,
            ]);
        }

        $notification = array(
            'message' => 'Product successfully added',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allproduct()
    {
        $product=Product::where('user_id', Auth::user()->id)->get();
        return view('seller.product.all_product', compact('product'));
    }

    public function editproduct($id)
    {
        $product=Product::findorfail($id);
        $brand=Brand::orderBy('brandname', 'ASC')->get();
        $category=Category::orderBy('categoryname', 'ASC')->get();
        $shop=Shop::where('user_id', Auth::user()->id)->orderBy('shopname', 'ASC')->get();
        return view('seller.product.edit_product', compact('product', 'brand', 'category', 'shop'));
    }

    public function updateproduct(Request $request, $id){
        $validatedData = $request->validate([
            'productid' => ['required', 'string', 'max:255'],
            'productname' => ['required', 'string', 'max:255'],
            'productmodel' => ['required', 'string', 'max:255'],
            'brand' => ['required'],
            'category' => ['required'],
            'productcolor' => ['required', 'string', 'max:255'],
            'shop' => ['required'],
            'coverimage' => ['image', 'max:2048'],
            'otherimages.*' => ['image', 'max:2048'],
            'regularprice' => ['required', 'string', 'max:255'],
            'discountedprice' => ['required', 'string', 'max:255'],
            'productquantity' => ['required', 'string', 'max:255'],
            'productdescription' => ['required', 'string', 'max:1500'],
        ]);

        $product = Product::findorfail($id);
        $product->productid=$request->productid;
        $product->productname=$request->productname;
        $product->productmodel=$request->productmodel;
        $product->productcolor=$request->productcolor;
        $product->productdescription=$request->productdescription;
        $product->regularprice=$request->regularprice;
        $product->discountedprice=$request->discountedprice;
        $product->user_id=Auth::user()->id;
        $product->brand_id=$request->brand;
        $product->category_id=$request->category;
        $product->shop_id=$request->shop;
        $image = $request->file('coverimage');
        if($image){
            $old_image=$request->old_image;
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $name = hexdec(uniqid());
            $extension = $image->getClientOriginalExtension();
            $fullname = $name.'.'.$extension;
            $path = 'public/images/products/images/';
            $url = $path.$fullname;
            $resize_image=Image::make($image->getRealPath());
            $resize_image->resize(500,500);
            $resize_image->save('public/images/products/images/'.$fullname);
            $product->coverimage = $url;
            $product->save();
        }
        else{
            $product->save();
        }
        $images = $request->file('otherimages');
        if ($images) {
            $otherimages_id=$request->otherimages_id;
            $old_otherimages=$request->old_otherimages;
            foreach ($old_otherimages as $old_othrimg) {
                if(file_exists($old_othrimg)){
                    unlink($old_othrimg);
                }
            }
            foreach ($otherimages_id as $othrimg_id) {
                $otherimage=Otherimage::findorfail($othrimg_id);
                $otherimage->delete();
            }
            foreach ($images as $img) {
                $name = hexdec(uniqid());
                $extension = $img->getClientOriginalExtension();
                $fullname = $name.'.'.$extension;
                $path = 'public/images/products/images/otherimages/';
                $url = $path.$fullname;
                $resize_image=Image::make($img->getRealPath());
                $resize_image->resize(500,500);
                $resize_image->save('public/images/products/images/otherimages/'.$fullname);
                Otherimage::create([
                    'otherimage' => $url,
                    'product_id' => $product->id,
                ]);
            }
        }

        $notification = array(
            'message' => 'Product successfully updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.product')->with($notification);
    }

    public function deleteproduct($id){
        $product=Product::findorfail($id);
        $image=$product->coverimage;
        if(file_exists($image)){
            unlink($image);
            $product->delete();
        }
        else{
            $product->delete();
        }

        $notification = array(
            'message' => 'Product successfully deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function sellerprocessingorder(){
        $user_id = Auth::user()->id;
        $product_id=Product::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('product_id', $product_id)->get();
        return view('seller.order.processing_order', compact('orderdetail'));
    }

    public function sellercompletedorder(){
        $user_id = Auth::user()->id;
        $product_id=Product::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('product_id', $product_id)->get();
        return view('seller.order.completed_order', compact('orderdetail'));
    }

    public function sellercanceledorder(){
        $user_id = Auth::user()->id;
        $product_id=Product::where('user_id', $user_id)->pluck('id');
        $orderdetail=Orderdetail::whereIn('product_id', $product_id)->get();
        return view('seller.order.canceled_order', compact('orderdetail'));
    }

    public function sellervieworder($id){
        $orderdetail=Orderdetail::findorfail($id);
        return view('seller.order.view_order', compact('orderdetail'));
    }

    public function packageorder($id){
        $orderdetail=Orderdetail::findorfail($id);
        $orderdetail->status = 'Packaged';
        $orderdetail->save();

        $notification = array(
            'message' => 'Product successfully Packaged',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function shiporder($id){
        $orderdetail=Orderdetail::findorfail($id);
        $orderdetail->status = 'Shipped';
        $orderdetail->save();

        $notification = array(
            'message' => 'Product successfully Shipped',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function deliverorder($id){
        $orderdetail=Orderdetail::findorfail($id);
        $orderdetail->status = 'Delivered';
        $orderdetail->save();

        $notification = array(
            'message' => 'Product successfully Delivered',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
