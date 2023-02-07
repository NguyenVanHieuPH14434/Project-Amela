<?php

namespace App\Services;

use App\Models\Replies;

class RepliesService {

    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function insertReplies ($req) {
        $content = $this->contentService->insertContent($req);

        $new = new Replies();
        $new->fill($req->all());
        $new->content_id = $content;
        $new->save();
    }

}
