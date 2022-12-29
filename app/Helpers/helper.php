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
