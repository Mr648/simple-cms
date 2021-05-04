<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class CommentObserver extends BaseObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Comment "created" event.
     *
     * @param Comment $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $this->modifyUserPoints($comment, 10, self::INCREASE);
    }

    /**
     * Handle the Comment "created" event.
     *
     * @param Comment $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {


        Log::channel('point_decrements')
            ->info('Something happened!');
    }
}
