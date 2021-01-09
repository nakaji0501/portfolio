<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\Question;

class CommentController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }

    /**
     * コメント投稿
     * @param Question $question
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function addComment(Question $question, \App\Http\Requests\CreateCommentRequest $request, $id)
    {
        $comment = new Comment;
        $comment->message = $request->message;
        $comment->user_id = Auth::user()->id;
        $comment->question_id = $request->id;
        // $question->comments()->save($comment);
        Auth::user()->comments()->save($comment);
        // authorリレーションをロードするためにコメントを取得しなおす
        $new_comment = Comment::where('id', $comment->id)->with(['author', 'question'])->first();

        return response($new_comment, 201);
    }
}