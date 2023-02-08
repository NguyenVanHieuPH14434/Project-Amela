<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use App\Repositories\Content\ContentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface{

    protected $contentRepo;

    public function getModel()
    {
        return Comment::class;
    }

    public function __construct(ContentRepositoryInterface $contentRepo)
    {
        parent::__construct($contentRepo);
        $this->contentRepo = $contentRepo;
    }

    public function insertComment($req)
    {
        $content = $this->contentRepo->insertContent($req);

        $new = new $this->model();
        $new->fill($req->all());
        $new->content_id = $content;
        $new->save();
    }
}