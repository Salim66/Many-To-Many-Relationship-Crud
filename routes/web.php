<?php

use App\Models\Role;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/create', function(){

    $user = User::findOrFail(1);
    $role = new Role(['name' => 'administrator']);
    $user->roles()->save($role);

});

Route::get('/read', function(){

    $user = User::findOrFail(1);

    foreach($user->roles as $role){
        echo $role->name;
    }

});

Route::get('/update', function(){

    $user = User::findOrFail(1);

    if($user->has('roles')){

        foreach($user->roles as $role){

            if($role->name == 'administrator'){
                $role->name = 'subscriber';
                $role->save();
            }

        }

    }

});


Route::get('/delete', function(){

    $user = User::findOrFail(1);

    foreach($user->roles as $role){
        $role->whereId(3)->delete();
    }

});


Route::get('/attach', function(){

    $user = User::findOrFail(1);

    $user->roles()->attach(4);

});


Route::get('/detach', function(){

    $user = User::findOrFail(1);
    $user->roles()->detach(3);

});


// duplicate data not create and duplicate data automatically detach
Route::get('/sync', function(){

    // $user = User::findOrFail(2);
    $user = User::findOrFail(1);
    $user->roles()->sync([4,5]);

});
