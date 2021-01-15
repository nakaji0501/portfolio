<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Comment extends Model
{

    /** JSONに含める属性 */
    protected $visible = [
        'id',
        'message',
        'question_id',
        'created_at',
        'author',
        'question',
    ];

    /**
     * リレーションシップ - usersテーブル
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }

    /**
     * リレーションシップ - questionsテーブル
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id', 'id', 'questions');
        // ('対象のモデル', '子の外部キー', '親のモデルの主キー')
    }
}
