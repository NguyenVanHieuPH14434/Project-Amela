<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Jobs\JobMail;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Repositories\OrderStatus\OrderStatusRepositoryInterface;
use Illuminate\Http\Request;
use Str;

class OrderCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $orderRepo;
    protected $orderDetailRepo;
    protected $statusOrderRepo;
    public $message = [];
    public function __construct(OrderRepositoryInterface $orderRepo, OrderItemRepositoryInterface $orderDetailRepo, OrderStatusRepositoryInterface $statusOrderRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->orderDetailRepo = $orderDetailRepo;
        $this->statusOrderRepo = $statusOrderRepo;
    }

    public function index()
    {
        $listOrder = $this->orderRepo->getOrder();
        $listStatusOrder = $this->statusOrderRepo->getOrderStatus();
        return view('pages.order.list', compact('listOrder', 'listStatusOrder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderDetail = $this->orderDetailRepo->getOrderDetail($id);
        return view('pages.order.show', compact('orderDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->orderRepo->find($id);
        $listStatusOrder = $this->statusOrderRepo->getOrderStatus();
        return view('pages.order.edit', compact('order', 'listStatusOrder'));
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
        try {
           $data =  $this->orderRepo->updateOrder($request, $id);
           $mailData = [
            'title'=>'Thông báo đơn hàng #'. $data[0]['getOrder']->code_order . ' ' . Str::lower($data[0]['getOrder']['getStatuss']->status_name),
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
        
            $this->message = ['success' => 'Cập nhật trạng thái đơn hàng thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
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
