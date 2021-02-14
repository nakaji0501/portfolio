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

// トークンリフレッシュ
Route::get('/reflesh-token', function (Illuminate\Http\Request $request) {
    $request->session()->regenerateToken();

    return response()->json();
});

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
Route::get('/questions/{id}', 'QuestionController@detaile')->name('question.detaile');

// 質問削除
Route::delete('/questions/{id}', 'QuestionController@delete')->name('question.delete');


//////////CommentController//////////
/// コメント投稿
Route::post('/questions/{id}/comments', 'CommentController@addComment')->name('comment.addComment');
// コメント削除
Route::delete('questions/comments/{id}', 'CommentController@delete')->name('comment.delete');

//////////PhotoController//////////
// 写真投稿
Route::post('/photos', 'PhotoController@create')->name('photo.create');
// 写真一覧
Route::get('/photos', 'PhotoController@index')->name('photo.index');