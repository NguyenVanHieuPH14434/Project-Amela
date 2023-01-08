<?php

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
