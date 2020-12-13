<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    public function addbrand()
    {
        return view('admin.brand.add_brand');
    }

    public function storebrand(Request $request){
        $validatedData = $request->validate([
            'serialnumber' => ['required', 'string', 'max:255', 'unique:brands'],
            'brandname' => ['required', 'string', 'max:255', 'unique:brands'],
        ]);

        $brand = new Brand;
        $brand->serialnumber=$request->serialnumber;
        $brand->brandname=$request->brandname;
        $brand->save();

        $notification = array(
            'message' => 'Brand successfully added',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allbrand()
    {
        $brand=Brand::all();
        return view('admin.brand.all_brand', compact('brand'));
    }

    public function editbrand($id){
        $brand = Brand::findorfail($id);
        return view('admin.brand.edit_brand', compact('brand'));
    }

    public function updatebrand(Request $request, $id){
        $validatedData = $request->validate([
            'serialnumber' => ['required', 'string', 'max:255'],
            'brandname' => ['required', 'string', 'max:255'],
        ]);

        $brand = Brand::findorfail($id);
        $brand->serialnumber=$request->serialnumber;
        $brand->brandname=$request->brandname;
        $brand->save();

        $notification = array(
            'message' => 'Brand successfully updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.brand')->with($notification);
    }

    public function deletebrand($id){
        $brand=Brand::findorfail($id);
        $brand->delete();

        $notification = array(
            'message' => 'Brand successfully deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function addcategory()
    {
        return view('admin.category.add_category');
    }

    public function storecategory(Request $request){
        $validatedData = $request->validate([
            'serialnumber' => ['required', 'string', 'max:255', 'unique:categories'],
            'categoryname' => ['required', 'string', 'max:255', 'unique:categories'],
        ]);

        $category = new Category;
        $category->serialnumber=$request->serialnumber;
        $category->categoryname=$request->categoryname;
        $category->save();

        $notification = array(
            'message' => 'Category successfully added',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allcategory()
    {
        $category=Category::all();
        return view('admin.category.all_category', compact('category'));
    }

    public function editcategory($id){
        $category = Category::findorfail($id);
        return view('admin.category.edit_category', compact('category'));
    }

    public function updatecategory(Request $request, $id){
        $validatedData = $request->validate([
            'serialnumber' => ['required', 'string', 'max:255'],
            'categoryname' => ['required', 'string', 'max:255'],
        ]);

        $category = Category::findorfail($id);
        $category->serialnumber=$request->serialnumber;
        $category->categoryname=$request->categoryname;
        $category->save();

        $notification = array(
            'message' => 'Category successfully updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.category')->with($notification);
    }

    public function deletecategory($id){
        $category=Category::findorfail($id);
        $category->delete();

        $notification = array(
            'message' => 'Category successfully deleted',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function notapprovedseller()
    {
        $seller=User::where('approved', '0')->get();
        return view('admin.seller.approve_seller', compact('seller'));
    }

    public function approveseller($id)
    {
        $seller=User::findorfail($id);
        $seller->approved='1';
        $seller->save();

        $notification = array(
            'message' => 'Seller successfully approved',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allseller()
    {
        $seller=User::where('type', 'seller')->where('approved', '1')->get();
        return view('admin.seller.all_seller', compact('seller'));
    }

    public function suspendseller($id)
    {
        $seller=User::findorfail($id);
        $seller->approved='0';
        $seller->save();

        $notification = array(
            'message' => 'Seller successfully suspended',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }
}
