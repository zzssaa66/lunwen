<?php

use Illuminate\Support\Facades\Route;

// 根路由：返回 welcome 视图，ExampleTest 需要 GET '/' 返回 200
Route::get('/', function () {
    return view('welcome');
});

// 引入 Breeze 生成的认证路由（login, register, password reset, email verification, confirm-password, logout 等）
// 请确保项目中存在 routes/auth.php，并正确注册了如下路由
require __DIR__ . '/auth.php';

// Dashboard 路由：登录后可访问
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Profile 相关路由：需有 App\Http\Controllers\ProfileController 实现 edit/update/destroy/updatePassword
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])
         ->name('profile.password.update');
});

// 论文审核系统：作者 (author) 端
use App\Http\Controllers\PaperController;
Route::middleware(['auth','role:author'])->group(function () {
    // resource 会生成以下命名路由：
    // papers.index, papers.create, papers.store, papers.show, papers.edit, papers.update
    Route::resource('papers', PaperController::class)->except(['destroy']);
    // 额外下载路由
    Route::get('/papers/{paper}/download', [PaperController::class, 'download'])
         ->name('papers.download');
});

// 论文审核系统：评审者 (reviewer) 端，带 name 前缀 reviewer.
use App\Http\Controllers\Reviewer\ReviewController;
Route::prefix('reviewer')->middleware(['auth','role:reviewer'])->name('reviewer.')->group(function () {
    // 生成 reviewer.papers.index, reviewer.papers.show
    Route::resource('papers', ReviewController::class)->only(['index','show']);
    // 提交评审意见
    Route::post('papers/{paper}/review', [ReviewController::class, 'store'])
         ->name('papers.review.submit');
});

// 论文审核系统：管理员 (admin) 端，带 name 前缀 admin.
use App\Http\Controllers\Admin\PaperAdminController;
use App\Http\Controllers\Admin\UserAdminController;
Route::prefix('admin')->middleware(['auth','role:admin'])->name('admin.')->group(function () {
    // 论文管理
    Route::get('papers', [PaperAdminController::class, 'index'])->name('papers.index');
    Route::get('papers/{paper}', [PaperAdminController::class, 'show'])->name('papers.show');
    Route::post('papers/{paper}/assign', [PaperAdminController::class, 'assignReviewers'])->name('papers.assign');
    Route::post('papers/{paper}/decision', [PaperAdminController::class, 'makeDecision'])->name('papers.decision');

    // 用户管理
    Route::get('users', [UserAdminController::class, 'index'])->name('users.index');
    Route::post('users/{user}/role', [UserAdminController::class, 'updateRole'])->name('users.updateRole');
});