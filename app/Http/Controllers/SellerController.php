<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Product;
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
        $brand=Brand::all();
        $category=Category::all();
        $shop=Shop::where('user_id', Auth::user()->id)->get();
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
            'productsize' => ['required', 'string', 'max:255'],
            'shop' => ['required'],
            'coverimage' => ['required', 'image', 'max:2048'],
            'regularprice' => ['required', 'string', 'max:255'],
            'discountedprice' => ['required', 'string', 'max:255'],
            'productdescription' => ['required', 'string', 'max:255'],
        ]);

        $product = new Product;
        $product->productid=$request->productid;
        $product->productname=$request->productname;
        $product->productmodel=$request->productmodel;
        $product->productcolor=$request->productcolor;
        $product->productsize=$request->productsize;
        $image = $request->file('coverimage');
        $name = hexdec(uniqid());
        $extension = $image->getClientOriginalExtension();
        $fullname = $name.'.'.$extension;
        $path = 'images/products/images/';
        $url = $path.$fullname;
        $upload = $image->move($path,$fullname);
        $product->coverimage = $url;
        $product->productdescription=$request->productdescription;
        $product->regularprice=$request->regularprice;
        $product->discountedprice=$request->discountedprice;
        $product->user_id=Auth::user()->id;
        $product->brand_id=$request->brand;
        $product->category_id=$request->category;
        $product->shop_id=$request->shop;
        $product->save();

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
        $brand=Brand::all();
        $category=Category::all();
        $shop=Shop::where('user_id', Auth::user()->id)->get();
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
            'productsize' => ['required', 'string', 'max:255'],
            'shop' => ['required'],
            'coverimage' => ['image', 'max:2048'],
            'regularprice' => ['required', 'string', 'max:255'],
            'discountedprice' => ['required', 'string', 'max:255'],
            'productdescription' => ['required', 'string', 'max:255'],
        ]);

        $product = Product::findorfail($id);
        $product->productid=$request->productid;
        $product->productname=$request->productname;
        $product->productmodel=$request->productmodel;
        $product->productcolor=$request->productcolor;
        $product->productsize=$request->productsize;
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
            $path = 'images/products/images/';
            $url = $path.$fullname;
            $upload = $image->move($path,$fullname);
            $product->coverimage = $url;
            $product->save();
        }
        else{
            $product->save();
        }

        $notification = array(
            'message' => 'Product successfully updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.product')->with($notification);
    }

    public function deleteproduct($id){
        $product=Product::findorfail($id);
        $product->delete();

        $notification = array(
            'message' => 'Product successfully deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }
}
