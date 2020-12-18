<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return Questions::all();
    }

    public function show(Question $question)
    {
        return $question;
    }

    public function store(Request $request)
    {
        return Questons::create($request->all());
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