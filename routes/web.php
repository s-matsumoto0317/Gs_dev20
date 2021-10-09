<?php
use App\Post;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 内省投稿一覧表示(posts.blade.php)
Route::get('/', 'PostsController@index');

// 内省投稿処理
Route::post('posts', 'PostsController@store');

//新規投稿ページを表示
Route::get('posts/new', 'PostsController@create');

// 価値観の選択肢挿入
Route::post('/process', 'PostsController@process');

//いいね処理
Route::post('post/{post_id}', 'PostsController@favo');

// 投稿を削除
Route::delete('/post/{post}','PostsController@destroy');

//「投稿」を更新画面表示(getではなく、postかもしれない)
Route::get('/postsedit/{id}','PostsController@edit');

//「投稿」を更新処理
Route::post('posts/update','PostsController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');