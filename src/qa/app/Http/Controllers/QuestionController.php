<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

use App\Comment;
use App\Http\Requests\StoreComment;

class QuestionController extends Controller
{
    public function index()
    {
        return Question::all();
    }

    public function show(Question $question)
    {
        return $question;
    }

    public function store(Request $request)
    {
        return Question::create($request->all());
    }

    public function update(Request $request, Question $Question)
    {
        $question->update($request->all());
        return $question;
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return $question;
    }

    /**
     * コメント投稿
     * @param Question $question
     * @param StoreComment $request
     * @return \Illuminate\Http\Response
     */
    public function addComment(Question $question, StoreComment $request)
    {
        $comment = new Comment();
        $comment->content = $request->get('content');
        $comment->user_id = Auth::user()->id;
        $photo->comments()->save($comment);

        // authorリレーションをロードするためにコメントを取得しなおす
        $new_comment = Comment::where('id', $comment->id)->with('author')->first();

        return response($new_comment, 201);
    }
}