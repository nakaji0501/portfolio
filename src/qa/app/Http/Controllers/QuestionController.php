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
        return Question::all();
    }

    /**
     * 投稿
     * @param \App\Http\Requests\CreateQuestionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $question = new Question;
        $question->text = $request->text;
        $question->title = $request->title;

        Auth::user()->questions()->save($question);

        return response($question, 201);
    }

    public function detaile(Question $question)
    {
        return $question;
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