<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }

    public function sellerindex()
    {
        return view('seller.home');
    }

    public function notapprovedsellerindex()
    {
        return view('seller.not_approved_home');
    }

    public function adminindex()
    {
        $seller=User::where('approved', '0')->get();
        return view('admin.home', compact('seller'));
    }
}
