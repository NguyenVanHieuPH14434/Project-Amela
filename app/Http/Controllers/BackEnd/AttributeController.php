<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Services\AttributeService;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $serviceAttribute;
    public $message = [];
    public function __construct(AttributeService $serviceAttribute)
    {
        $this->serviceAttribute = $serviceAttribute;
    }
    public function index()
    {
        $listAttr = $this->serviceAttribute->getPaginateAttribute();
        return view('pages.attribute.list', compact('listAttr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->serviceAttribute->insertAttribute($request);
            $this->message = ['success' => 'Thêm thuộc tính thành công!'];
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
        $attr = Attribute::findOrFail($id);
        return view('pages.attribute.edit', compact('attr'));
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
            $this->serviceAttribute->updateAttribute($request, $id);
            $this->message = ['success' => 'Cập nhật thuộc tính thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }

    public function search (Request $request) {
        $key = trim($_GET['key']);
        $requestData = ['attr_name'];
        if($key != ''){
            $listAttr = Attribute::where('parent_id', 0)->where(querySearchByColumns($requestData, $key))
            ->paginate(10);
        }else{
            $listAttr = $this->serviceAttribute->getPaginateAttribute();

        }
        return view('pages.attribute.list', compact('listAttr'));
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
           $attr = Attribute::findOrFail($id);
           $attr->getSubAttribute()->delete();
           $attr->delete();
            $this->message = ['success' => 'Xóa thuộc tính thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }
}
