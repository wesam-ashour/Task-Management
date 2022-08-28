<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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

Route::permanentRedirect('/', 'login');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');
    Route::get('lang/change', [Controller::class, 'change'])->name('changeLang');

    Route::patch('/fcm-token', [Controller::class, 'updateToken'])->name('fcmToken');
    Route::post('/send-notification', [NotificationController::class, 'notification'])->name('notification');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UsersController::class);
    Route::resource('clients', ClientsController::class);
    Route::resource('projects', ProjectsController::class);
    Route::resource('tasks', TasksController::class);
    Route::resource('notifications', NotificationController::class);

    Route::get('users/restore/{id}', [UsersController::class, 'restore'])->name('users.restore');
    Route::get('users/restore-all', [UsersController::class, 'restoreAll'])->name('users.restoreAll');
//    Route::post('/mark-as-read', [RegisteredUserController::class, 'markNotification'])->name('markNotification');
    Route::get('/markAllAsRead', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');

    Route::get('/search-with-pagination', function () {
        return view('clients.index');
    });
    Route::post('search', [ProjectsController::class, 'search'])->name('search');

    Route::put('taskComplete/{id}', [TasksController::class, 'taskComplete'])->name('taskComplete');


});

require __DIR__ . '/auth.php';
