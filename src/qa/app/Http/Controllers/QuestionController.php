<?php

namespace App\Http\Controllers;

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
}
