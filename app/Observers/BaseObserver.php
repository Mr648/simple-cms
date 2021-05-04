<?php


namespace App\Observers;


use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class BaseObserver
{


    const DECREASE = 'decrease';
    const INCREASE = 'increase';

    /**
     * @param Model $model
     * @param $amount
     * @param $user
     * @param $method
     */
    protected function modifyUserPoints(Model $model, $amount, $method)
    {
        $user = null;
        $post = null;
        $channel = null;
        if ($model instanceof Comment || $model instanceof Post) {
            $model->load('user');
            $user = $model->user;
            if ($model instanceof Comment) {
                $post = Post::where('id', $model->commentable_id)->first();
            }
        } else {
            return;
        }
        $points = $user->points;
        switch ($method) {
            case self::INCREASE:
                {
                    $points += $amount;
                    if (!is_null($post)) {
                        $this->modifyUserPoints($post, 5, self::INCREASE);
                    }
                    $channel = [
                        'name' => 'point_increments',
                        'message' => sprintf('User #%d Points Increased! new points = %d', $user->id, $points)
                    ];
                }
                break;
            case self::DECREASE:
                {
                    $points -= $amount;
                    if (!is_null($post)) {
                        $this->modifyUserPoints($post, 5, self::DECREASE);
                    }
                    $channel = [
                        'name' => 'point_decrements',
                        'message' => sprintf('User #%d Points Decreased! new points = %d', $user->id, $points)
                    ];
                }
                break;
        }

        $user->points = $points;
        $user->save();

        Log::channel($channel['name'])->info($channel['message']);
    }
}
