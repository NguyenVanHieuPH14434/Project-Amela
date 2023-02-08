<?php

use App\Models\Order;

    if(!function_exists('defaultImage')){
        function defaultImage() {
            return 'images/products/default-thumbnail.jpg';
        }
    }


    if(!function_exists('fileUpload')){
        function fileUpload ($file, $prefixName = '', $folder){
            $fileName = $file->hashName();
            $fileName = $prefixName
            ? $prefixName.'_'.$fileName
            : time() .'_'.$fileName;
            return $file->storeAs($folder, $fileName);
        }
    }


    if(!function_exists('checkIssetImage')){
        function checkIssetImage ($req, $data=['image'=>'', 'prefixName'=>'', 'folder'=>'', 'imageOld'=>'']) {
            $dataImage = '';
            if($req->hasFile($data['image'])){
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

    if(!function_exists('querySearchByColumns')){
        function querySearchByColumns($requestData = array(), $key){
          return function ($q) use ($requestData, $key) {
                foreach ($requestData as $field)
                   $q->orWhere($field, 'like', "%{$key}%");
            };
        }
    }

    if(!function_exists('sortOrder')){
        function sortOrder (){
            $sortOrder = 'desc';
            if(request('sortOrder') && in_array(request('sortOrder'), ['asc', 'desc'])){
                $sortOrder = request('sortOrder');
            }
            return $sortOrder;
        }
    }
    
    if(!function_exists('sortBy')){
        function sortBy ($sortByColumns = []){
            $sortBy = 'id';
            if(request('sortBy') && in_array(request('sortBy'), $sortByColumns)){
                $sortBy = request('sortBy');
            }
            return $sortBy;
        }
    }

    if(!function_exists('generateUniqueCode')){
        function generateUniqueCode()
        {
            do {
                $referal_code = random_int(100000000000, 999999999999);
            } while (Order::where("id", "=", $referal_code)->first());
    
            return $referal_code;
        }
    }

    if(!function_exists('scopeFilter')){
        function scopeFilter($q, $columns = [])
    {
        if (request('keyword')) {
            $q->where(querySearchByColumns($columns, request('keyword')));
        }
        if (request('price_from')) {
            $q->wherebetween('product_price', [(int)request('price_from'), (int)request('price_to')]);
        }

        return $q;
    }
    }
