<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Http\Request;

class OrderCOntroller extends Controller
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
        $this->orderRepo = $orderRepo;
        $this->orderDetailRepo = $orderDetailRepo;
    }

    public function index()
    {
        $listOrder = $this->orderRepo->getOrder();
        return view('pages.order.list', compact('listOrder'));
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
        //
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
