<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\Admin\PaperAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Reviewer\ReviewController;

// Breeze 已生成 auth 路由：login、register、logout 等

// 作者端路由，仅 Author 角色可访问
Route::middleware(['auth','role:author'])->group(function(){
    Route::get('/papers','PaperController@index')->name('papers.index');
    Route::get('/papers/create','PaperController@create')->name('papers.create');
    Route::post('/papers','PaperController@store')->name('papers.store');
    Route::get('/papers/{paper}','PaperController@show')->name('papers.show');
    Route::get('/papers/{paper}/edit','PaperController@edit')->name('papers.edit');
    Route::put('/papers/{paper}','PaperController@update')->name('papers.update');
    Route::get('/papers/{paper}/download','PaperController@download')->name('papers.download');
});

// 管理员端路由，仅 Admin 角色
Route::prefix('admin')->middleware(['auth','role:admin'])->group(function(){
    Route::get('papers','PaperAdminController@index')->name('admin.papers.index');
    Route::get('papers/{paper}','PaperAdminController@show')->name('admin.papers.show');
    Route::post('papers/{paper}/assign','PaperAdminController@assignReviewers')->name('admin.papers.assign');
    Route::post('papers/{paper}/decision','PaperAdminController@makeDecision')->name('admin.papers.decision');
    // 用户管理
    Route::get('users','UserAdminController@index')->name('admin.users.index');
    Route::post('users/{user}/role','UserAdminController@updateRole')->name('admin.users.updateRole');
});

// 评审者端路由，仅 Reviewer 角色
Route::prefix('reviewer')->middleware(['auth','role:reviewer'])->group(function(){
    Route::get('papers','ReviewController@index')->name('reviewer.papers.index');
    Route::get('papers/{paper}','ReviewController@show')->name('reviewer.papers.show');
    Route::post('papers/{paper}/review','ReviewController@store')->name('reviewer.papers.review.submit');
});