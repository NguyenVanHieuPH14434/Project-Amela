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
use Illuminate\Support\Facades\DB;
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

    public function dataChart (Request $req) {
        $date_from = $req->date_from;
        $date_to = $req->date_to;
   
        $products = getCountTable('products', [$date_from, $date_to]);
        $category = getCountAllTable('categories', ['deleted_at'], [null]);
        $product = getCountAllTable('products', ['deleted_at'], [null]);
        $order = getCountAllTable('orders', ['deleted_at'], [null]);
        $user = User::select(DB::raw('count(id) as total'))->where('deleted_at', null)->whereHas('user_role',function($q){
            $q->where('role_key', 'user');
        })->first();

        // $patientList = DB::table('patients')
        //     ->select(DB::raw('count(id) as patient_count, date'))
        //     ->whereBetween('date', [$date_from, $date_to])
        //     ->orderBy('date', 'asc')
        //     ->groupBy('date')
        //     ->get();

        // $totalPriceOrder = DB::table('orders')
        //     ->select(DB::raw('sum(total) as sum, date'))
        //     ->whereBetween('date', [$date_from, $date_to])
        //     ->orderBy('date', 'asc')
        //     ->groupBy('date')
        //     ->get();

        // $serviceTotal = DB::table('schedule_services')
        //     ->select(DB::raw('count(service_id) as totalService, date, services.service_name as serviceName, day(date) as day, month(date) as month, year(date) as year'))
        //     ->join('services', 'services.id', '=', 'schedule_services.service_id')
        //     ->whereBetween('date', [$date_from, $date_to])
        //     ->orderBy('date', 'asc')
        //     ->groupBy('serviceName', 'date', 'day', 'month', 'year')
        //     ->get();

        // $totalService = Service::select(DB::raw('count(id) as totalSer'))->get();

        // $maxService = getMaxTable('schedule_services', 'services', array('service_id', 'service_name'));

        // $totalEquipment = Equipment::select(DB::raw('count(id) as countEquipment'))->get();
        // $totalProduct = Product::select(DB::raw('count(id) as countProduct'))->get();
        // $totalStaff = Admin::select(DB::raw('count(id) as countStaff'))->get();
        // $totalNew = News::select(DB::raw('count(id) as countNew'))->get();


        // return json_decode($list1);
        return response()->json([
            "products" => $products,
            "category" => $category,
            "product" => $product,
            "order" => $order,
            "user" => $user,
          
        ]);
    }
}
