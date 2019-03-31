<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

// Mail
use App\Mail\userRegistered;
use Illuminate\Support\Facades\Mail;

// DB
use Illuminate\Support\Facades\DB as DB;

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
    protected $redirectTo = '/login';

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered ($user = $this->create($request->all())));

        return redirect('/login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token' => str_random(20)
        ]);
        //mengirim email
        Mail::to($user->email)->send(new userRegistered($user));
    }

    public function verify_register($token, $id)
    {
        // mengambil data user
        $user = User::find($id);
        //cek token apakah sama dengan di url
        if ($user->token != $token) {
            return redirect('/login')->with('warning', 'tokennya tidak cocok');
        }

        // ubah status user token 0 menjadi 1
        $user->status = 1;
        $user->save();

        // $this->guard()->login($user);
        return redirect('/login')->with('success', 'akun '. $user->name .' berhasil di aktifkan');
    }
}
