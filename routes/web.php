<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::get('/article/detail', function(){
//     return view('article-detail');
// });

Route::get('login', function(){
    return view('auth.login');
})->name('login');

Route::get('auth/google', [AuthController::class,'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [AuthController::class,'handleGoogleCallback'])->name('auth.googl.callback');

Route::middleware(['auth', 'role_or_permission:view user|create user|edit user|update user|delete user'])->group(function () {
    Route::get('admin/user/index' ,App\Livewire\Dashboard\User\Index::class)->name('user.index');
});
Route::middleware(['auth', 'role_or_permission:view dashboard'])->group(function () {
    Route::get('admin/dashboard/', App\Livewire\Dashboard\Index::class)->name('dashboard');
});

Route::middleware(['auth', 'role_or_permission:view role|create role|edit role|update role|delete role'])->group(function () {
    Route::get('admin/role/index' ,App\Livewire\Dashboard\Role\Index::class)->name('role.index');
});
Route::middleware(['auth', 'role_or_permission:view permission|create permission|edit permission|update permission|delete permission'])->group(function () {
    Route::get('admin/permission/index' ,App\Livewire\Dashboard\Permission\Index::class)->name('permission.index');
});

Route::get('admin/category/index' ,App\Livewire\Dashboard\Category\Index::class)->name('category.index');

Route::get('admin/book/index' ,App\Livewire\Dashboard\Book\Index::class)->name('book.index');
Route::get('admin/book/create' ,App\Livewire\Dashboard\Book\Create::class)->name('book.create');

use App\Http\Controllers\PostController;
// Route::get('/admin/post/index', [PostController::class,'index'])->name('post.index');
// Route::get('/admin/post/create', [PostController::class,'create'])->name('post.create');
// Route::post('/admin/post/store', [PostController::class,'store'])->name('post.store');

Route::get('admin/post/index' ,App\Livewire\Dashboard\Post\Index::class)->name('post.index');
Route::get('admin/post/create', App\Livewire\Dashboard\Post\PostForm::class)->name('post.create');
Route::get('/admin/post/edit/{id}/', [PostController::class,'edit'])->name('post.edit');

Route::get('/admin/tutorial/index', App\Livewire\Dashboard\Tutorial\Index::class)->name('tutorial.index');



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//fontend

// use App\Http\Controllers\ArticleController;
// Route::get('{categorySlug}/{slug}', [ArticleController::class, 'detail'])->name('post.detail');
use App\Livewire\Front\Home;
Route::get('/', Home::class)->name('home');
use App\Livewire\Front\AboutMe;
Route::get('about-me', AboutMe::class)->name('about-me');
use App\Livewire\Front\GetArticleByCategory;
Route::get('{categorySlug}/', GetArticleByCategory::class)->name('get-article-by-category');
use App\Livewire\Front\PostDetail;
Route::get('{categorySlug}/{postSlug}', PostDetail::class)->name('post.detail');

