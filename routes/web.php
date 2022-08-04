<?php

use App\Http\Livewire\Collectable as LivewireCollectable;
use App\Http\Livewire\UserPublicProfile as LivewireUserPublicProfile;
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
})->name('welcome');

Route::get('/library', function () {
    return view('library');
})->name('library');

Route::get('/collectable/{id_col}', LivewireCollectable::class)
->name('collectable');

Route::get('/user/{user_id}', LivewireUserPublicProfile::class)
->name('user');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/chatroom', function () {
        return view('chatroom');
    })->name('chatroom');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/user/profile/collections', function () {
        return view('profile.collections');
    })->name('profile.collections');
});