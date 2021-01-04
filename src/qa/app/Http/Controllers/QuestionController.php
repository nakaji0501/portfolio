<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Question;

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
     * 指定されたIDの投稿の詳細（投稿と返信）を取得します
     * @return App\Question or 404エラー
     */
    public function detaile(string $id)
    {
        $question = Question::where('id', $id)->with(['user'])->first();
        return $question ?? abort(404);
    }

    public function update(Request $request, Question $Question)
    {
        $question->update($request->all());
        return $question;
    }

    public function delete(Question $question)
    {
        $question->delete();
        return $question;
    }
}