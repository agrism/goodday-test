<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Inertia\IndexController as PublicBlogIndexController;
use App\Http\Controllers\Inertia\ShowController as PublicBlogShowController;
use App\Http\Controllers\Inertia\News\IndexController as PublicNewsIndexController;
use App\Http\Controllers\Inertia\News\ShowController as PublicNewsShowController;
use App\Http\Controllers\Inertia\UserProfileController;
use App\Http\Controllers\Inertia\UpdateUserRolesController;
use App\Http\Controllers\Inertia\Admin\Permissions\IndexController as AdminPermissionsIndexController;
use App\Http\Controllers\Inertia\Admin\Permissions\RoleDetailsController;
use App\Http\Controllers\Inertia\Admin\Permissions\RoleUpdateController;

use App\Http\Controllers\Inertia\Admin\Blog\IndexController as AdminBlogIndexController;
use App\Http\Controllers\Inertia\Admin\Blog\EditController as AdminBlogEditController;
use App\Http\Controllers\Inertia\Admin\Blog\UpdateController as AdminBlogUpdateController;
use App\Http\Controllers\Inertia\Admin\Blog\CreateController as AdminBlogCreateController;
use App\Http\Controllers\Inertia\Admin\Blog\StoreController as AdminBlogStoreController;

use App\Http\Controllers\Inertia\Admin\News\IndexController as AdminNewsIndexController;
use App\Http\Controllers\Inertia\Admin\News\EditController as AdminNewsEditController;
use App\Http\Controllers\Inertia\Admin\News\UpdateController as AdminNewsUpdateController;
use App\Http\Controllers\Inertia\Admin\News\CreateController as AdminNewsCreateController;
use App\Http\Controllers\Inertia\Admin\News\StoreController as AdminNewsStoreController;




Route::get('/', PublicBlogIndexController::class)->name('blog.index');
Route::get('/blog/{slug}', PublicBlogShowController::class)->name('blog.show');
Route::get('/news', PublicNewsIndexController::class)->name('news.index');
Route::get('/news/{slug}', PublicNewsShowController::class)->name('news.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/admin/roles', AdminPermissionsIndexController::class)->name('admin.roles');

    Route::get('admin/role/{id}/details', RoleDetailsController::class)->name('admin.role.details');

    Route::post('admin/role/{id}/update', RoleUpdateController::class);

    Route::get('/admin/blog', AdminBlogIndexController::class)->name('admin.blog');
    Route::get('/admin/blog/{id}/edit', AdminBlogEditController::class)->name('admin.blog.edit');
    Route::put('/admin/blog/{id}/update', AdminBlogUpdateController::class)->name('admin.blog.update');
    Route::get('/admin/blog/create', AdminBlogCreateController::class)->name('admin.blog.create');
    Route::post('/admin/blog', AdminBlogStoreController::class)->name('admin.blog.store');

    Route::get('/admin/news', AdminNewsIndexController::class )->name('admin.news');
    Route::get('/admin/news/{id}/edit', AdminNewsEditController::class)->name('admin.news.edit');
    Route::get('/admin/news/create', AdminNewsCreateController::class )->name('admin.news.create');
    Route::post('/admin/news', AdminNewsStoreController::class )->name('admin.news.store');
    Route::put('/admin/news/{id}/update', AdminNewsUpdateController::class)->name('admin.news.update');
});

Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    $authMiddleware = config('jetstream.guard') ? 'auth:'.config('jetstream.guard') : 'auth';

    $authSessionMiddleware = config('jetstream.auth_session', false) ? config('jetstream.auth_session') : null;

    Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware]))], function () {
        // User & Profile...
        Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
    });
});

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    // Role Information...
    Route::put('/user/roles-information', UpdateUserRolesController::class)
        ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
        ->name('user-roles-information.update');


});
