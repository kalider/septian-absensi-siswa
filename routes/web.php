<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
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

Route::get('/', [HomeController::class, 'index'])->middleware([OnlyMemberMiddleware::class]);

Route::controller(\App\Http\Controllers\UserController::class)->group(function() {
    Route::get('/login', 'login')->middleware([OnlyGuestMiddleware::class]);
    Route::post('/login', 'doLogin')->middleware([OnlyGuestMiddleware::class]);
    Route::post('/logout', 'doLogout')->middleware([OnlyMemberMiddleware::class]);
    Route::get('/register', 'register')->middleware([OnlyGuestMiddleware::class]);
    Route::post('/register', 'doRegister')->middleware([OnlyGuestMiddleware::class]);
});

Route::controller(\App\Http\Controllers\StudentController::class)->middleware([OnlyMemberMiddleware::class])->group(function() {
    Route::get('/student', 'index');
    Route::get('/student/create', 'create');
    Route::post('/student/create', 'doCreate');
    Route::get('/student/{id}/edit', 'edit');
    Route::post('/student/{id}/edit', 'doEdit');
    Route::post('/student/{id}/delete', 'doDelete');

});

Route::controller(\App\Http\Controllers\DepartmentController::class)->middleware([OnlyMemberMiddleware::class])->group(function() {
    Route::get('/department', 'index');
    Route::get('/department/create', 'create');
    Route::post('/department/create', 'doCreate');
    Route::get('/department/{id}/edit', 'edit');
    Route::post('/department/{id}/edit', 'doEdit');
    Route::post('/department/{id}/delete', 'doDelete');
});

Route::controller(\App\Http\Controllers\ClassController::class)->middleware([OnlyMemberMiddleware::class])->group(function() {
    Route::get('/class', 'index');
    Route::get('/class/create', 'create');
    Route::post('/class/create', 'doCreate');
    Route::get('/class/{id}/edit', 'edit');
    Route::post('/class/{id}/edit', 'doEdit');
    Route::post('/class/{id}/delete', 'doDelete');

});

Route::controller(\App\Http\Controllers\TeacherController::class)->middleware([OnlyMemberMiddleware::class])->group(function() {
    Route::get('/teacher', 'index');
    Route::get('/teacher/create', 'create');
    Route::post('/teacher/create', 'doCreate');
    Route::get('/teacher/{id}/edit', 'edit');
    Route::post('/teacher/{id}/edit', 'doEdit');
    Route::post('/teacher/{id}/delete', 'doDelete');
});

Route::controller(\App\Http\Controllers\LessonController::class)->middleware([OnlyMemberMiddleware::class])->group(function() {
    Route::get('/lesson', 'index');
    Route::get('/lesson/create', 'create');
    Route::post('/lesson/create', 'doCreate');
    Route::get('/lesson/{id}/edit', 'edit');
    Route::post('/lesson/{id}/edit', 'doEdit');
    Route::post('/lesson/{id}/delete', 'doDelete');

});

Route::controller(\App\Http\Controllers\ScheduleController::class)->middleware([OnlyMemberMiddleware::class])->group(function() {
    Route::get('/schedule', 'index');
    Route::get('/schedule/create', 'create');
    Route::post('/schedule/create', 'doCreate');
    Route::get('/schedule/{id}/edit', 'edit');
    Route::post('/schedule/{id}/edit', 'doEdit');
    Route::post('/schedule/{id}/delete', 'doDelete');

});

Route::controller(\App\Http\Controllers\PresenceController::class)->middleware([OnlyMemberMiddleware::class])->group(function() {
    Route::get('/presence', 'index');
    Route::get('/presence/create', 'create');
    Route::post('/presence/create', 'doCreate');
    Route::get('/presence/{id}/edit', 'edit');
    Route::post('/presence/{id}/edit', 'doEdit');
    Route::post('/presence/{id}/delete', 'doDelete');
    Route::get('/presence/{id}/pres', 'pres');
    Route::post('/presence/{id}/pres', 'doPres');
});
