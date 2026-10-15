<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Публичные маршруты (доступны всем)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/articles/{id}', [ArticleController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('articles.show');

// Гостевые маршруты
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Список всех категорий
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Статьи одной категории
Route::get('/categories/{id}', [CategoryController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('categories.show');

// Авторизованные маршруты
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Журналист: роли 2 (Журналист) и 3 (Администратор)
    Route::middleware('role:2,3')->group(function () {
        Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    });

    // Администратор: только роль 3
Route::middleware('role:3')->prefix('admin')->name('admin.')->group(function () {
    // Список статей и пользователей
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Изменение роли пользователя
    Route::post('/users/{id}/role', [AdminController::class, 'updateRole'])->name('users.updateRole');

    // Редактирование статьи
    Route::get('/articles/{id}/edit', [AdminController::class, 'editArticle'])->name('articles.edit');
    Route::put('/articles/{id}', [AdminController::class, 'updateArticle'])->name('articles.update');

    // Удаление статьи
    Route::delete('/articles/{id}', [AdminController::class, 'destroyArticle'])->name('articles.destroy');
});
});