<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Sellerdetail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(isset($data['type']) && $data['type'] == 'Seller'){
            return Validator::make($data, [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string'],
                'dob' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255', 'unique:users'],
                'bkashnumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255', 'unique:sellerdetails'],
                'rocketnumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{12}|\d{14})$/', 'max:255', 'unique:sellerdetails'],
                'image' => ['image', 'max:2048'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        else{
            return Validator::make($data, [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'string'],
                'dob' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phonenumber' => ['required', 'string', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/', 'max:255', 'unique:users'],
                'image' => ['image', 'max:2048'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $users = User::all();
        if(count($users) > 0){
            if(isset($data['type']) && $data['type'] == 'Seller'){
                $user = User::create([
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'gender' => $data['gender'],
                    'dob' => $data['dob'],
                    'email' => $data['email'],
                    'phonenumber' => $data['phonenumber'],
                    'type' => 'Seller',
                    'password' => Hash::make($data['password']),
                ]);
                $image = request()->file('image');
                if($image){
                    $name = hexdec(uniqid());
                    $extension = $image->getClientOriginalExtension();
                    $fullname = $name.'.'.$extension;
                    $path = 'public/images/users/images/';
                    $url = $path.$fullname;
                    $upload = $image->move($path,$fullname);
                    $user->update(['image' => $url]);
                }
                Sellerdetail::create([
                    'bkashnumber' => $data['bkashnumber'],
                    'rocketnumber' => $data['rocketnumber'],
                    'user_id'  => $user->id,
                ]);
                return $user;
            }
            else{
                $user = User::create([
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'gender' => $data['gender'],
                    'dob' => $data['dob'],
                    'email' => $data['email'],
                    'phonenumber' => $data['phonenumber'],
                    'type' => 'Buyer',
                    'approved' => true,
                    'password' => Hash::make($data['password']),
                ]);
                $image = request()->file('image');
                if($image){
                    $name = hexdec(uniqid());
                    $extension = $image->getClientOriginalExtension();
                    $fullname = $name.'.'.$extension;
                    $path = 'public/images/users/images/';
                    $url = $path.$fullname;
                    $upload = $image->move($path,$fullname);
                    $user->update(['image' => $url]);
                }
                return $user;
            }
        }
        else{
            $user = User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'gender' => $data['gender'],
                'dob' => $data['dob'],
                'email' => $data['email'],
                'phonenumber' => $data['phonenumber'],
                'type' => 'Admin',
                'approved' => true,
                'password' => Hash::make($data['password']),
            ]);
            $image = request()->file('image');
            if($image){
                $name = hexdec(uniqid());
                $extension = $image->getClientOriginalExtension();
                $fullname = $name.'.'.$extension;
                $path = 'public/images/users/images/';
                $url = $path.$fullname;
                $upload = $image->move($path,$fullname);
                $user->update(['image' => $url]);
            }
            return $user;
        }
    }
}
