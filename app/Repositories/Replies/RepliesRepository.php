<?php

namespace App\Repositories\Replies;

use App\Models\Replies;
use App\Repositories\BaseRepository;
use App\Repositories\Content\ContentRepositoryInterface;

class RepliesRepository extends BaseRepository implements RepliesRepositoryInterface {
    
    protected $contentRepo;

    public function getModel()
    {
        return Replies::class;
    }

    public function __construct(ContentRepositoryInterface $contentRepo)
    {
        parent::__construct($contentRepo);
        $this->contentRepo = $contentRepo;
    }

    public function insertReplies ($req) {
        $content = $this->contentRepo->insertContent($req);
        $new = new $this->model();
        $new->fill($req->all());
        $new->content_id = $content;
        $new->save();
    }
}