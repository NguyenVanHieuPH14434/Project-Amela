<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\JobMail;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Services\OrderItemService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $orderRepo;
    protected $orderDetailRepo;
    public function __construct(OrderRepositoryInterface $orderRepo, OrderItemRepositoryInterface $orderDetailRepo)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->orderRepo = $orderRepo;
        $this->orderDetailRepo = $orderDetailRepo;
    }

    public function index()
    {
        $listOrder = $this->orderRepo->getPaginateOrder(Auth::guard('api')->id());
        $account = Auth::guard('api')->user();
        return response()->json([
            "success"=>true,
            "message"=>"Danh sách đơn hàng người dùng ". $account->getProfile->full_name,
            "data"=>$listOrder
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $this->orderRepo->insertOrder($request);
            DB::commit();
            $mailData = [
                'title'=>'Thông báo đặt hàng thành công!',
                'customer'=>$data[0]['getOrder']->customer,
                'email'=>$data[0]['getOrder']->email,
                'code_order'=>$data[0]['getOrder']->code_order,
                'total_price'=>$data[0]['getOrder']->total_price,
                'phone'=>$data[0]['getOrder']->phone,
                'address'=>$data[0]['getOrder']->address,
                'viewMail'=>'emails.mailOrder',
                'items'=>$data
            ];
            dispatch(new JobMail($data[0]['getOrder']->email, $mailData));
            return response()->json([
                "success"=>true,
                "message"=>"Đặt hàng thành công!",
                "data"=>$data
            ], 201);
        } catch (\Throwable $err) {
            DB::rollBack();
            report($err->getMessage());
            return response()->json([
                "success"=>false,
                "message"=>"Đã xảy ra lỗi!",
                "data"=>$err->getMessage()
            ], 500);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listOrderDetail = $this->orderDetailRepo->getOrderDetail($id);
        return response()->json([
            "success"=>true,
            "message"=>"Dữ liệu đơn hàng",
            "data"=>$listOrderDetail
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}