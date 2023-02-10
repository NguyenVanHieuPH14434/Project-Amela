<?php

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


    // set default image 
    if(!function_exists('defaultImage')){
        function defaultImage() {
            return 'images/products/default-thumbnail.jpg';
        }
    }


    // save file
    if(!function_exists('fileUpload')){
        function fileUpload ($file, $prefixName = '', $folder){
            $fileName = $file->hashName();
            $fileName = $prefixName
            ? $prefixName.'_'.$fileName
            : time() .'_'.$fileName;
            return $file->storeAs($folder, $fileName);
        }
    }


    // check exist image
    if(!function_exists('checkIssetImage')){
        function checkIssetImage ($req, $data=['image'=>'', 'prefixName'=>'', 'folder'=>'', 'imageOld'=>'']) {
            $dataImage = '';
            if($req->hasFile($data['image'])){
                deleteFile($data['imageOld']);
                $file = $req->file($data['image']);
                $dataImage = fileUpload($file, $data['prefixName'], $data['folder']);
            }elseif($data['imageOld']){
                $dataImage = $data['imageOld'];
            }
            else{
                $dataImage = defaultImage();
            }
            return $dataImage;
        }

    }

    // search by columns
    if(!function_exists('querySearchByColumns')){
        function querySearchByColumns($requestData = array(), $key){
          return function ($q) use ($requestData, $key) {
                foreach ($requestData as $field)
                   $q->orWhere($field, 'like', "%{$key}%");
            };
        }
    }

    // multiple where
    if(!function_exists('queryByColumns')){
        function queryByColumns($columns = array(), $value = array()){
          return function ($q) use ($columns, $value) {
                foreach ($columns as $index => $field)
                   $q->where($field, $value[$index]);
            };
        }
    }

    // sort desc, asc
    if(!function_exists('sortOrder')){
        function sortOrder (){
            $sortOrder = 'desc';
            if(request('sortOrder') && in_array(request('sortOrder'), ['asc', 'desc'])){
                $sortOrder = request('sortOrder');
            }
            return $sortOrder;
        }
    }
    
    // sort by columns
    if(!function_exists('sortBy')){
        function sortBy ($sortByColumns = []){
            $sortBy = 'id';
            if(request('sortBy') && in_array(request('sortBy'), $sortByColumns)){
                $sortBy = request('sortBy');
            }
            return $sortBy;
        }
    }

    // unique code 
    if(!function_exists('generateUniqueCode')){
        function generateUniqueCode()
        {
            do {
                $referal_code = random_int(100000000000, 999999999999);
            } while (Order::where("id", "=", $referal_code)->first());
    
            return $referal_code;
        }
    }

    // filter
    if(!function_exists('scopeFilter')){
        function scopeFilter($q, $columns = [])
        {
            if (request('keyword')) {
                $q->where(querySearchByColumns($columns, request('keyword')));
            }
            if (request('price_from')) {
                $q->wherebetween('product_price', [(int)request('price_from'), (int)request('price_to')]);
            }

            if(request('category')){
                $q->whereHas('categoryProduct', function($q){
                    $q->where('cate_name', 'like', "%".request('category')."%");
                });
            }

            return $q;
        }
    }

    // delete file in storage
    if(!function_exists('deleteFile')){
        function deleteFile ($dataImage) {
            if(Storage::exists($dataImage)){
                Storage::delete($dataImage);
            }
        }
    }

    // count all item of table
    if(!function_exists('getCountTable')){
        function getCountTable ($table, $date = array(), $columns = array(), $value = array()) {
            $dateS = count($date) != 0?new Carbon($date[0]):Carbon::now()->format('Y-m-d');
            $dateE = count($date) != 0?new Carbon($date[1]):Carbon::now()->format('Y-m-d');

            $data = DB::table($table)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as total'))
            ->whereBetween('created_at', [$dateS, $dateE->addDays(1)->format('Y-m-d')]);

            if(count($columns) != 0){ 
                $data->where(queryByColumns($columns, $value));
            }

            $result = $data->orderBy('date', 'asc')
            ->groupBy('date')
            ->get();
            return $result;
        }
    };

    if(!function_exists('responData')){
        function responData ($keys=[], $value=[]) {
            $data = [];
            // foreach($keys as $index => $key){
            //     $dt = $key .'=>' .$value[$index] .',';
            //     array_push($data, $key .'=>' .$value[$index] .',');
            // }
            return response()->json($keys);
        }
    }
