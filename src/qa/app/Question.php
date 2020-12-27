<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Question extends Model
{
    protected $fillable = [
        'title',
        'text',
    ];
}
