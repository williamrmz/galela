<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Com;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    public function login (Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Ingrese el nombre de usuario',
            'password.required' => 'Ingrese su contraseña',
        ]);

        // Attempt to log the user in
        if ( $this->attemptLogin($request) ) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('home'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }


    protected function attemptLogin(Request $request)
    {
        $user = User::where('username', $request->username)->get()->first();
        
        if($user){
            $passCryp = $user->password;
            $crypKey = new COM("CrypKey.Util") or die("error");
            $passDecryp = $crypKey->DecryptString($passCryp);

            if( $request->password == $passDecryp){
                $this->guard()->login($user, $request->has('remember'));
                return true;
            }
        }
        return false;
    }
}
