<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Hamlet;
use App\Models\GarbageCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = 'member/account';
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $garbageCategories = GarbageCategory::all();
        $hamlets = Hamlet::all();
        return view('auth.register', compact('garbageCategories', 'hamlets'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nik' => ['required', 'string', 'max:20', 'unique:users'],
            'phone' => ['string', 'max:20', 'unique:users'],
            'garbage_category_id' => ['required', 'numeric'],
            'garbage_can_location' => ['required', 'string'],
            'hamlet_id' => ['required', 'numeric'],
            'rt' => ['required', 'string'],
            'address' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nik' => $data['nik'],
            'phone' => $data['phone'],
            'garbage_category_id' => $data['garbage_category_id'],
            'garbage_can_location' => $data['garbage_can_location'],
            'garbage_can_picture' => '',
            'hamlet_id' => $data['hamlet_id'],
            'rt' => $data['rt'],
            'address' => $data['address'],
            'status' => 0
        ]);
    }
}
