<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index (){
        return view('auth.login');
    }

    public function checklogin (LoginRequest $req) {

        try {
            $user = User::where('username', $req->username)->first();
            $getMessage = [];
            if($user){
                if(Auth::attempt(['username'=>$req->username, 'password'=>$req->password])){
                     return redirect()->route('dashboard');
                }elseif(!Auth::attempt(['password'=>$req->password])){
                    $getMessage = ['errPassword'=>'Password invalid!'];
                    return redirect()->route('login')->withInput($req->only('username', 'remember'))->with($getMessage);
                }
            }else{
                $getMessage = ['errUsername'=>'Username not found!'];
                return redirect()->route('login')->withInput($req->only('username', 'remember'))->with($getMessage);
            }
        } catch (\Throwable $th) {
            report($th->getMessage());
            return redirect()->route('login')->with('err', 'Có lỗi xảy ra!');
        }
    }

    public function logout (Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
