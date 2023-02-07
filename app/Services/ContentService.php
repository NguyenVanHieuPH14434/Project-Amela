<?php

namespace App\Services;

use App\Models\Content;
use Illuminate\Support\Facades\Auth;

class ContentService {

    public function insertContent ($req) {
        $content = new Content();
        $content->fill($req->all());
        $content->user_id = Auth::guard('api')->id();
        $content->save();
        return $content->id;
    }
}
