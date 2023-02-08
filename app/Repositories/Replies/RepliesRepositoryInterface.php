<?php

namespace App\Repositories\Replies;

use App\Repositories\RepositoryInterface;

interface RepliesRepositoryInterface extends RepositoryInterface {

    public function insertReplies ($req);
}