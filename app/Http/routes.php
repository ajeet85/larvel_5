<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::group(['middleware' => 'web'], function() {
    // Place all your web routes here...(Cut all `Route` which are define in `Route file`, paste here) 
	
Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('templateexample', 'WelcomeController@template_example');
Route::get('logout', 'Auth\AuthController@logout');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::resource('books','BookController');
});

// API routes...
Route::get('users/{user}',function(App\User $user){
return $user;

});

// API routes... pass the model class in function
Route::get('books/{book}',function(App\Model\Book $book){
return $book;

});

// API routes...
Route::get('/api/v1/books/{id?}', ['middleware' => 'auth.basic', function($id = null) {
if ($id == null) {
    $products = App\Model\Book::all(array('name','cat_id','author','image'));//modal filable value
} else {
    $products =  App\Model\Book::find($id, array('name','cat_id','author','image'));
}
return Response::json(array(
            'error' => false,
            'products' => $products,
            'status_code' => 200
        ));
}]);
