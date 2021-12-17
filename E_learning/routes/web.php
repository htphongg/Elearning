<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DangNhapController;
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
    // return view('layouts/login/forgot-password');
    return view('index');
});

Route::get('/trang_chu', function () {
    // return view('layouts/login/forgot-password');
    return view('/layouts/student/index');
})->name('trang_chu_sv');


Route::get('/them_lop', function () {
    return view('/layouts/student/addclass');
})->name('them_lop');


Route::get('/lop', function () {
    return view('/layouts/student/class');
})->name('lop');

Route::get('/bai_tap', function () {
    return view('/layouts/student/work');
})->name('bai_tap');

Route::get('/moi_ngoi', function () {
    return view('/layouts/student/everybody');
})->name('moi_nguoi');
