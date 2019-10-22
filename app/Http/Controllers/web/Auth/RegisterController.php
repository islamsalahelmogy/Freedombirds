<?php

namespace App\Http\Controllers\web\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;


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
    protected $redirectTo = '/home';

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
            'bio'=>['required'],
            'image_url'=>['required']
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        if($request->hasFile('image_url')){
            if($request->file('image_url')->extension() == 'jpg' 
            ||$request->file('image_url')->extension() == 'jpeg'
            ||$request->file('image_url')->extension() == 'png') {
                $filename = $request->image_url->getClientOriginalName();
                
                $file = $request->image_url->storeAs('public/upload',$filename);

                event(new Registered($user = $this->create($request->all(),$filename)));

                $this->guard()->login($user);

                return $this->registered($request, $user)
                                ?: redirect($this->redirectPath());

            }
            else 
            {
              return redirect(route('register'))->withInput($request->all())
              ->withErrors(['message' => 'upload file(jpg,jpeg,png)']);
            }
        }
        
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data,$file)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'bio' => $data['bio'],
            'image_url'=> $file,
        ]);
            
        
    }
}
