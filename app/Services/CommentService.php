<?php

namespace App\Services;

use App\Constant\Constanst;
use App\Models\Category;
use App\Models\CategoryNew;
use App\Models\Comment;
use App\Models\News;
use App\Models\Permission;
use App\Models\Role;
use DateTime;

class CommentService {


    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function insertComment ($req) {
        $content = $this->contentService->insertContent($req);

        $new = new Comment();
        $new->fill($req->all());
        $new->content_id = $content;
        $new->save();
    }

}
