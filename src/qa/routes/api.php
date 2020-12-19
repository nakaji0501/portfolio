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

// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');

// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// ログインユーザー
Route::get('/user', fn() => Auth::user())->name('user');

// 質問一覧
Route::get('/questions', 'QuestionController@index');

// 質問詳細取得
Route::get('/questions/{question}', 'QuestionController@show');

// 質問登録
Route::post('/questions', 'QuestionController@store');

// 質問更新
Route::put('/questions/{question}', 'QuestionController@update');

// 質問削除
Route::delete('/questions/{question}', 'QuestionController@destroy');