<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/dashboard', 'HomeController@dashboard');

Route::group(['middleware' => 'auth'], function () {
    
});


/** Module Publications **/
Route::resource('publications', 'PublicationController');


Route::post('json',function(){
    if (Input::isJson())
    {
        $request = Input::all();
        $article = Article::find($request['id']);
        if (!is_null($article))
        {
            return Response::json($article);
        }
        else return Response::json(['error' => "Object not found"],404);
    }
    else return "not json";
});