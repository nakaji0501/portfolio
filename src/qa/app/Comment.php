<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** JSONに含める属性 */
    protected $visible = [
        'author',
        'content',
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
     * リレーションシップ - questionsテーブル　返信元の投稿を取得する
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function postQuestion()
    {
        return $this->belongsTo('App\Question', 'question_id', 'id');
        // ('対象のモデル', '子の外部キー', '親のモデルの主キー')
    }
}
