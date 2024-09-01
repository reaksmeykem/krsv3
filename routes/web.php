<?php




use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;


use App\Livewire\Login;
Route::get('auth/login', Login::class)->name('login');

// Route::get('login', Login::class)->name('login');
use App\Http\Controllers\AuthController;
Route::get('logout', [AuthController::class,'logout'])->name('logout');

Route::get('auth/google', [AuthController::class,'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [AuthController::class,'handleGoogleCallback'])->name('auth.googl.callback');

Route::get('auth/github', [AuthController::class, 'redirectToGithub'])->name('auth.github');
Route::get('auth/github/callback', [AuthController::class,'handleGithubCallback'])->name('auth.github.callback');


// dashboard
use App\Livewire\Dashboard;
Route::middleware(['auth', 'role_or_permission:view dashboard'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});
use App\Livewire\PermissionForm;
Route::middleware(['auth', 'role_or_permission:view permission|create permission|edit permission|update permission|delete permission'])->group(function () {
    Route::get('permission', PermissionForm::class)->name('permission');
});
use App\Livewire\UserForm;
Route::middleware(['auth', 'role_or_permission:view user|create user|edit user|update user|delete user'])->group(function () {
    Route::get('user', UserForm::class)->name('user');
});
use App\Livewire\RoleForm;
Route::middleware(['auth', 'role_or_permission:view role|create role|edit role|update role|delete role'])->group(function () {
    Route::get('role', RoleForm::class)->name('role');
});

use App\Livewire\CategoryForm;
Route::middleware(['auth', 'role_or_permission:view category|create category|edit category|update category|delete category'])->group(function () {
    Route::get('category', CategoryForm::class)->name('category');
});
use App\Livewire\PostForm;
use App\Livewire\PostCreate;
use App\Livewire\PostEdit;
Route::middleware(['auth', 'role_or_permission:view post|create post|edit post|update post|delete post'])->group(function () {
    Route::get('post', PostForm::class)->name('post');
    Route::get('post/create', PostCreate::class)->name('post.create');
    Route::get('post/edit/{id}', PostEdit::class)->name('post.edit');
});
use App\Livewire\TagForm;
Route::middleware(['auth', 'role_or_permission:view tag|create tag|edit tag|update tag|delete tag'])->group(function () {
    Route::get('tag', TagForm::class)->name('tag');
});

use App\Livewire\ContactList;
Route::middleware(['auth', 'role_or_permission:view contact'])->group(function () {
    Route::get('contact-list', ContactList::class)->name('contactList');
});

use App\Livewire\TutorialForm;
Route::get('tutorial', TutorialForm::class)->name('tutorial');

use App\Livewire\SettingForm;
Route::get('setting', SettingForm::class)->name('setting');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

use App\Http\Controllers\ContactController;
use App\Livewire\Front\Home;
use App\Livewire\AboutMe;
use App\Livewire\Front\ContactForm;
use App\Livewire\Front\GetPostbyCategory;
use App\Livewire\CookieConsent;
use App\Livewire\Front\PostDetail;
use App\Livewire\GetPostByTag;
// track visitors

Route::middleware(['track.visits'])->group(function () {
    Route::get('/sitemap.xml', function () {
        return response()->file(storage_path('app/public/sitemap.xml'));
    })->name('sitemap');
    Route::get('terms-and-privacy', [HomeController::class,'TermsAndPrivacy'])->name('TermsAndPrivacy');
    // Route::get('cookie-consent', [HomeController::class,'cookieConsent'])->name('cookieConsent');
    // Route::get('contact', [ContactController::class,'contact'])->name('contact');
    // Route::get('about-me', [PostController::class,'aboutMe'])->name('about');
    // Route::get('tag/{tagSlug}', [PostController::class,'getPostByTag'])->name('getPostByTag');
    // Route::get('/', [HomeController::class,'index'])->name('home');

    Route::get('/', Home::class)->name('home');
    Route::get('/about-me', AboutMe::class)->name('about');
    Route::get('/contact', ContactForm::class)->name('contact');
    Route::get('cookie-consent', CookieConsent::class)->name('cookieConsent');
    Route::get('{categorySlug}', GetPostbyCategory::class)->name('getPostByCategory');
    Route::get('tag/{tagSlug}', GetPostByTag::class)->name('getPostByTag');
    Route::get('{categorySlug}/{postSlug}', PostDetail::class)->name('postDetail');

    // Route::get('{categorySlug}', [PostController::class,'getPostByCategory'])->name('getPostByCategory');
    // Route::get('{categorySlug}/{postSlug}', [PostController::class,'postDetail'])->name('postDetail');

    // for frontend
});

