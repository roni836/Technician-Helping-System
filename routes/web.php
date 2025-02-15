<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\DecisionTreeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::post('/brand', [CommonController::class, 'brandStore'])->name('brand.store');
Route::post('/problem', [CommonController::class, 'problemStore'])->name('problem.store');
Route::post('/device', [CommonController::class, 'deviceStore'])->name('device.store');
Route::post('/modelno', [CommonController::class, 'modelnoStore'])->name('modelno.store');


Route::get('/', [DecisionTreeController::class, 'start'])->name('decision_tree.start');
Route::post('/decision-tree/problems', [DecisionTreeController::class, 'getProblems'])->name('decision_tree.get_problems');Route::match(['get', 'post'], '/decision-tree/show-model', [DecisionTreeController::class, 'showModel'])
->name('decision_tree.show_model');

Route::match(['get','post'],'/decision-tree/show', [DecisionTreeController::class, 'show'])->name('decision_tree.show');
Route::get('/decision-tree/question/{id}', [DecisionTreeController::class, 'showQuestion'])->name('decision_tree.show_question');
Route::post('/decision-tree/question/{id}/answer', [DecisionTreeController::class, 'answer'])->name('decision_tree.answer');

Route::post('/decision-tree/add-question', [DecisionTreeController::class, 'addQuestion'])->name('decision_tree.add_question');
Route::post('/decision-tree/add-starting-question', [DecisionTreeController::class, 'addStartingQuestion'])->name('decision_tree.add__starting_question');
Route::get('/decision_tree/question/{id}/edit', [DecisionTreeController::class, 'editQuestion'])->name('decision_tree.edit_question');
Route::post('/decision_tree/question/{id}/update', [DecisionTreeController::class, 'updateQuestion'])->name('decision_tree.update_question');




Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DecisionTreeController::class, 'start'])->name('dashboard');
});


Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/decision-tree/question/{id}', [DecisionTreeController::class, 'showQuestion'])->name('decision_tree.show_question');
   Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
   Route::get('/admin/users',[AdminController::class,'index'])->name('admin.users');
   Route::get('/admin/user/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
   Route::post('/admin/user/{id}/update', [AdminController::class, 'update'])->name('admin.update');
   Route::delete('/admin/user/{id}/delete', [AdminController::class, 'destroy'])->name('admin.delete');
   
   
});
