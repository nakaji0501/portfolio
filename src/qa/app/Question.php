<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

use App\comment;

class Question extends Model
{
    /** JSONに含める属性 */
    protected $visible = [
        'id',
        'title',
        'created_at',
        'user',
        'message',
        'comments',
    ];

    /**
     * リレーションシップ - usersテーブル　投稿の投稿者を取得する
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
        // ('対象のモデル', '子の外部キー', '親のモデルの主キー')
    }

    /**
     * リレーションシップ - commentsテーブル
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'question_id', 'id')->orderBy('id', 'desc');
    }
}
