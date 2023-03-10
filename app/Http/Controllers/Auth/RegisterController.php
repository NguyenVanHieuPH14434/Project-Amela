<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\JobMail;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
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
    public $serviceUser;
    public $message;

    public function __construct(UserService $serviceUser, $message = [])
    {
        $this->serviceUser = $serviceUser;
        $this->message = $message;
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(RegisterRequest $req)
    {
        try {
            $this->serviceUser->insertUser($req);

            $content = 'Ch??ng t??i ???? t???o cho b???n t??i kho???n tr??n website v???i t??i kho???n l?? : ' . $req->username . ' , m???t kh???u: ' . $req->password . 
            ' . Vui l??ng kh??ng ti???t l??? th??ng tin n??y cho b???t k?? ai.';

            dispatch(new JobMail($req->email, mailData("Th??ng b??o ????ng k?? t??i kho???n th??nh c??ng!", 'emails.sendMail', $req->full_name, $content)));
            
            $this->message = ['success' => '????ng k?? ng?????i d??ng th??nh c??ng!'];
        } catch (\Exception $err) {
                report($err->getMessage());
                $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->route('login')->with($this->message);

    }
}
