<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestion;
use App\Question;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
}