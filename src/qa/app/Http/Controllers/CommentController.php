<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\CreateCommentRequest;
use Illuminate\Support\Facades\Auth;

use App\Comment;

class CommentController extends Controller
{
    /**
     * コメント投稿
     * @param Question $question
     * @param CreateCommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function addComment(Question $question, CreateCommentRequest $request)
    {
        $comment = new Comment();
        $comment->content = $request->get('content');
        $comment->user_id = Auth::user()->id;
        $question->comments()->save($comment);

        // authorリレーションをロードするためにコメントを取得しなおす
        $new_comment = Comment::where('id', $comment->id)->with('author')->first();

        return response($new_comment, 201);
    }
}