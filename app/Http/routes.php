<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/-', function () {
    return view('welcome');
});
Route::get('/hello',function(){
    return "Hello Laravel[GET]!";
});

Route::get('/testPost',function(){
    $csrf_token = csrf_token();
    $form = <<<FORM
        <form action="/hello" method="POST">
            <input type="hidden" name="_token" value="{$csrf_token}">
            <input type="submit" value="Test"/>
        </form>
FORM;
    return $form;
});

Route::post('/hello',function(){
    return "Hello Laravel[POST]!";
});
#参数
Route::get('/hello/{name}',function($name){
    return "Hello {$name}!";
});
#多个参数
Route::get('/hello/{name}/by/{user}',function($name,$user){
    return "Hello {$name} by {$user}!";
});
#注意以上参数是必选的，如果没有输入参数会抛出MethodNotAllowedHttpException或NotFoundHttpException异常。

#此外闭包函数中的参数与路由参数一一对应。
Route::get('/hello/{name}/{user}',function($name,$user){
    return "Hello {$name} by {$user}!";
});

Route::get('/hello1/{name?}',function($name="Laravel"){
    return "Hello {$name}!";
});

#取别名
/*Route::get('/hello/laravelacademy',['as'=>'academy',function(){
    return 'Hello LaravelAcademy！';
}]);*/

Route::get('/hello/laravelacademy1/{id}',['as'=>'academy',function($id){
    return 'Hello LaravelAcademy2 '.$id.'！';
}]);

Route::get('/testNamedRoute',function(){
    return redirect()->route('academy');
});

Route::get('/testNamedRoute1',function(){
    return redirect()->route('academy',['id'=>2]);
});

Route::get('/testNamedRoute2',function(){
    return redirect()->route('admin::dashboard2');
});

Route::group(['as' => 'admin::'], function () {
    Route::get('dashboard3', ['as' => 'dashboard2', function () {
        return "Hello hahhah!";
    }]);
});


Route::group(['middleware'=>'test'],function(){
    Route::get('/write/laravelacademy',function(){
        //使用Test中间件
    });
    Route::get('/update/laravelacademy',function(){
        //使用Test中间件
    });
});

Route::get('/age/refuse',['as'=>'refuse',function(){
    return "未成年人禁止入内！";
}]);
