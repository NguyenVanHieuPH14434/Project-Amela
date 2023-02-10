<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\SendMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\MailRegister;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function sendMailtest () {
        $user = User::first();
        Product::all();
        $user->getProfile->notify(new MailRegister("A new user has visited on your application."));
        // FacadesNotification::send($user->getProfile, new MailRegister('sss'));
        return response()->json([
            'data'=>$user,
            'data1'=>$user->getProfile,
        ]);
    }


    public function order (Request $req) {
        // dd($req->all());
        $cus = $req->data;
        return response()->json([
            'data'=>$req->data[0]['product_id'],
        ]);
    }

    public function chart () {
        $dataCate = Category::where('deleted_at', null)
        ->selectRaw('count(id) as totalCate')
        // ->groupBy('cate_name')
        ->get();

        $dataProduct = Product::where('deleted_at', null)
        ->selectRaw('count(id) as totalPro')
        // ->groupBy('product_name')
        ->get();


        dd($dataCate, $dataProduct);
    }

    public function testemail (){
        $testMailData = [
            'title' => 'Test Email From AllPHPTricks.com',
            'body' => 'This is the body of test email.'
        ];
        Mail::to('nguyenvanhieugl2001@gmail.com')->send(new SendMail($testMailData));
        dd('done!!!!!!');
    }
}
