<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStatusrequset;
use App\Repositories\OrderStatus\OrderStatusRepositoryInterface;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $orderStatusRepo;
    public $message = [];
    public function __construct(OrderStatusRepositoryInterface $orderStatusRepo)
    {
        $this->orderStatusRepo = $orderStatusRepo;
    }
    public function index()
    {
        $listOrderStatus = $this->orderStatusRepo->getOrderStatus();
        return view('pages.orderSatus.list', compact('listOrderStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.orderSatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusrequset $request)
    {
        try {
            $this->orderStatusRepo->insertOrderStatus($request);
            $this->message = ['success' => 'Thêm trạng thái thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderStatus = $this->orderStatusRepo->find($id);
        return view('pages.orderSatus.edit', compact('orderStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStatusrequset $request, $id)
    {
        try {
            $this->orderStatusRepo->updateOrderStatus($request, $id);
            $this->message = ['success' => 'Cập nhật trạng thái thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }

    
    public function search (Request $request) {
        if($_GET['key'] && $_GET['key'] != ''){
              $listOrderStatus = $this->orderStatusRepo->search($_GET['key'], ['status_name']);
              return view('pages.orderSatus.list', compact('listOrderStatus'));
        }
        return redirect()->route('orderStatus.index');
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->orderStatusRepo->softDelete($id);
            $this->message = ['success' => 'Xóa trạng thái thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }
}
