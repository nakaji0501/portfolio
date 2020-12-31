<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//////////ユーザー登録・認証など//////////
// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');

// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// ログインユーザー
Route::get('/user', fn() => Auth::user())->name('user');


//////////QuestionController//////////
// 質問一覧
Route::get('/questions', 'QuestionController@index')->name('question.index');

// 質問登録
Route::post('/questions', 'QuestionController@create')->name('question.create');

// 質問詳細取得
Route::get('/questions/{question}', 'QuestionController@detaile')->name('question.detaile');

// 質問更新
// Route::put('/questions/{question}', 'QuestionController@update');

// 質問削除
Route::delete('/questions/{question}', 'QuestionController@delete')->name('question.delete');


//////////CommentController//////////
/// コメント
Route::post('/questions/{question}/comments', 'QuestionController@addComment')->name('question.comment');
