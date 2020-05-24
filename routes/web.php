<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/blog')->name('home');
Route::redirect('/admin', '/login?role=admin');

Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get('/blog/create', 'BlogController@create')->name('blog.create');
Route::post('/blog/store', 'BlogController@store')->name('blog.store');
Route::get('/blog/{slug}', 'BlogController@show')->name('blog.show');
Route::get('/blog/{slug}/edit', 'BlogController@edit')->name('blog.edit');
Route::put('/blog/{slug}', 'BlogController@update')->name('blog.update');
Route::get('/blog/{slug}/delete', 'BlogController@destroy')->name('blog.destroy');

Route::post('/image', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'file' => 'required|file',
    ]);

    $path = $request->file->storeAs('public/media', sha1_file($request->file->path()) . '.' . $request->file->extension());

    return response()->json(['image' => ['path' => '/storage/media/' . basename($path)]]);
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

