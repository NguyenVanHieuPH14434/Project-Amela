<?php

namespace App\Repositories\Content;

use App\Models\Content;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class ContentRepository extends BaseRepository implements ContentRepositoryInterface {
    public function getModel()
    {
        return Content::class;
    }

    public function insertContent($req)
    {
        $content = new $this->model();
        $content->fill($req->all());
        $content->user_id = Auth::guard('api')->id();
        $content->save();
        return $content->id;
    }
}