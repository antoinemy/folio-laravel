<?php

namespace App\Http\Controllers\Auth;

use App\Http\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class AuthController extends Controller
{
	private $rules = [
		'email' => 'required',
        'password' => 'required',
    ];

	protected $auth;

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
	    $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'lastname' => 'required|max:255',
            'firstname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'lastname' => 'required|max:255',
            'firstname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function getLogin() {
        return view('auth.login');
    }

    protected function postLogin(Request $request) {
        if ($this->auth->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard.index');
        }

        return redirect()->route('login')->withErrors(['Email ou mot de passe incorrect.']);
    }

    protected function getLogout()
    {
        $this->auth->logout();
        return redirect()->route('login')->withErrors(['Vous venez de vous déconnecter.']);
    }

}
