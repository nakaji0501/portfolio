<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DeleteQuestionRequest;

use App\Question;
use App\Comment;

class QuestionController extends Controller
{
    public function __construct()
    {
        /**
         * 認証が必要
         */
        $this->middleware('auth')
        ->except(['index', 'user', 'detaile']); //指定したメソッドは除外
    }

    /**
     * 投稿一覧取得
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with(['user'])
            ->orderBy('CREATED_AT', 'desc')->paginate(5);

        return $questions;
    }

    /**
     * 投稿
     * @param \App\Http\Requests\CreateQuestionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Http\Requests\CreateQuestionRequest $request)
    {
        $question = new Question;
        $question->message = $request->message;
        $question->title = $request->title;

        Auth::user()->questions()->save($question);

        return response($question, 201);
    }

    /**
     * 写真詳細
     * @param string $id
     * @return App\Question or 404エラー
     */
    public function detaile(string $id)
    {
        $question = Question::where('id', $id)
            ->with(['user', 'comments.author'])->first();
        return $question ?? abort(404);
    }

    /**
     * 投稿と紐づく返信を削除
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $question = Question::findOrFail($id);
        $question->comments()->delete();
        $question->delete();

        return response($question, 204);
    }
}