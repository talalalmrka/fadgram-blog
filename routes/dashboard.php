<?php
use App\Http\Controllers\Dashboard\Profile\ProfileController;
use App\Http\Controllers\Dashboard\Roles\RoleController;
use App\Http\Controllers\Dashboard\Permissions\PermissionController;
use App\Http\Controllers\Dashboard\Posts\PostController;
use App\Http\Controllers\Dashboard\Settings\SettingsController;
use App\Http\Controllers\Dashboard\Users\UserController;
use App\Http\Controllers\Media\MediaController;

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'dashboard'], function () {
    Route::view('/', 'dashboard')
        ->name('dashboard');

    /*Route::view('profile', 'profile')
        ->name('profile');*/
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::post('/account/update', [ProfileController::class, 'accountUpdate'])->name('profile.account.update');
        Route::post('/personal/update', [ProfileController::class, 'personalUpdate'])->name('profile.personal.update');
        Route::post('/contact/update', [ProfileController::class, 'contactUpdate'])->name('profile.contact.update');
    });
    //users
    Route::group(['prefix' => 'users', 'middleware' => ['can:manage users']], function () {

        Route::get('/', [UserController::class, 'index'])
            ->name('dashboard.users');

        Route::get('/edit/{user}', [UserController::class, 'edit'])
            ->name('dashboard.users.edit');

        Route::post('/update/{user}', [UserController::class, 'update'])
            ->name('dashboard.users.update');

        Route::get('/create', [UserController::class, 'create'])
            ->name('dashboard.users.create');

        Route::post('/store', [UserController::class, 'store'])
            ->name('dashboard.users.store');

        Route::get('/delete/{user}', [UserController::class, 'delete'])
            ->name('dashboard.users.delete');

        Route::post('/action', [UserController::class, 'action'])
            ->name('dashboard.users.action');

        Route::get('/login/{user}', [UserController::class, 'login'])
            ->name('dashboard.users.login');
    });


    //posts
    Route::group(['prefix' => 'posts', 'middleware' => ['can:manage posts']], function () {

        Route::get('/', [PostController::class, 'index'])
            ->name('dashboard.posts')
            ->middleware('auth');

        Route::get('/edit/{post}', [PostController::class, 'edit'])
            ->name('dashboard.posts.edit');

        Route::post('/update/{post}', [PostController::class, 'update'])
            ->name('dashboard.posts.update');

        Route::get('/create', [PostController::class, 'create'])
            ->name('dashboard.posts.create');

        Route::post('/store', [PostController::class, 'store'])
            ->name('dashboard.posts.store');

        Route::get('/delete/{post}', [PostController::class, 'delete'])
            ->name('dashboard.posts.delete');

        Route::post('/action', [PostController::class, 'action'])
            ->name('dashboard.posts.action');
    });
    //permissions
    Route::group(['prefix' => 'permissions', 'middleware' => ['can:manage permissions']], function () {

        Route::get('/', [PermissionController::class, 'index'])
            ->name('dashboard.permissions')
            ->middleware('auth');

        Route::get('/edit/{permission}', [PermissionController::class, 'edit'])
            ->name('dashboard.permissions.edit');

        Route::post('/update/{permission}', [PermissionController::class, 'update'])
            ->name('dashboard.permissions.update');

        Route::get('/create', [PermissionController::class, 'create'])
            ->name('dashboard.permissions.create');

        Route::post('/store', [PermissionController::class, 'store'])
            ->name('dashboard.permissions.store');

        Route::get('/delete/{permission}', [PermissionController::class, 'delete'])
            ->name('dashboard.permissions.delete');

        Route::post('/action', [PermissionController::class, 'action'])
            ->name('dashboard.permissions.action');
    });

    //roles
    Route::group(['prefix' => 'roles', 'middleware' => ['can:manage roles']], function () {

        Route::get('/', [RoleController::class, 'index'])
            ->name('dashboard.roles')
            ->middleware('auth');

        Route::get('/edit/{role}', [RoleController::class, 'edit'])
            ->name('dashboard.roles.edit');

        Route::post('/update/{role}', [RoleController::class, 'update'])
            ->name('dashboard.roles.update');

        Route::get('/create', [RoleController::class, 'create'])
            ->name('dashboard.roles.create');

        Route::post('/store', [RoleController::class, 'store'])
            ->name('dashboard.roles.store');

        Route::get('/delete/{role}', [RoleController::class, 'delete'])
            ->name('dashboard.roles.delete');

        Route::post('/action', [RoleController::class, 'action'])
            ->name('dashboard.roles.action');

    });
    //media
    Route::group(['prefix' => 'media', 'middleware' => ['can:manage media']], function () {

        Route::get('/', [MediaController::class, 'index'])
            ->name('dashboard.media');

        Route::post('/store', [MediaController::class, 'store'])
            ->name('dashboard.media.store');

        Route::get('/delete/{media}', [MediaController::class, 'delete'])
            ->name('dashboard.media.delete');

        Route::post('/action', [MediaController::class, 'action'])
            ->name('dashboard.media.action');
    });
    //settings
    Route::group(['prefix' => 'settings', 'middleware' => ['can:manage settings']], function () {
        Route::get('/general', [SettingsController::class, 'edit'])
            ->name('settings.general');
        Route::put('/general', [SettingsController::class, 'update'])->name('settings.update');
    });
});
/*use App\Http\Controllers\Dashboard\Roles\RoleController;
use App\Http\Controllers\Dashboard\Permissions\PermissionController;
use App\Http\Controllers\Dashboard\Posts\PostController;
use App\Http\Controllers\Dashboard\Users\UserController;

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'dashboard'], function () {
    Route::view('/', 'dashboard')
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

    //users
    Route::group(['prefix' => 'users', 'middleware' => ['can:manage users']], function () {
        Route::get('/', [UserController::class, 'index'])
            ->name('dashboard.users');

        Route::get('/edit/{user}', [UserController::class, 'edit'])
            ->name('dashboard.users.edit');

        Route::post('/update/{user}', [UserController::class, 'update'])
            ->name('dashboard.users.update');

        Route::get('/create', [UserController::class, 'create'])
            ->name('dashboard.users.create');

        Route::post('/store', [UserController::class, 'store'])
            ->name('dashboard.users.store');

        Route::get('/delete/{user}', [UserController::class, 'delete'])
            ->name('dashboard.users.delete');

        Route::post('/action', [UserController::class, 'action'])
            ->name('dashboard.users.action');

        Route::get('/login/{user}', [UserController::class, 'login'])
            ->name('dashboard.users.login');
    });


    //posts
    Route::get('/posts', [PostController::class, 'index'])
        ->name('dashboard.posts')
        ->middleware('auth');

    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])
        ->name('dashboard.posts.edit');

    Route::post('/posts/update/{post}', [PostController::class, 'update'])
        ->name('dashboard.posts.update');
    Route::get('/posts/create', [PostController::class, 'create'])
        ->name('dashboard.posts.create');

    Route::post('/posts/store', [PostController::class, 'store'])
        ->name('dashboard.posts.store');

    Route::get('/posts/delete/{post}', [PostController::class, 'delete'])
        ->name('dashboard.posts.delete');

    Route::post('/posts/action', [PostController::class, 'action'])
        ->name('dashboard.posts.action');

    //permissions
    Route::get('/permissions', [PermissionController::class, 'index'])
        ->name('dashboard.permissions')
        ->middleware('auth');

    Route::get('/permissions/edit/{permission}', [PermissionController::class, 'edit'])
        ->name('dashboard.permissions.edit');

    Route::post('/permissions/update/{permission}', [PermissionController::class, 'update'])
        ->name('dashboard.permissions.update');
    Route::get('/permissions/create', [PermissionController::class, 'create'])
        ->name('dashboard.permissions.create');

    Route::post('/permissions/store', [PermissionController::class, 'store'])
        ->name('dashboard.permissions.store');

    Route::get('/permissions/delete/{permission}', [PermissionController::class, 'delete'])
        ->name('dashboard.permissions.delete');

    Route::post('/permissions/action', [PermissionController::class, 'action'])
        ->name('dashboard.permissions.action');


    //roles
    Route::get('/roles', [RoleController::class, 'index'])
        ->name('dashboard.roles')
        ->middleware('auth');

    Route::get('/roles/edit/{role}', [RoleController::class, 'edit'])
        ->name('dashboard.roles.edit');

    Route::post('/roles/update/{role}', [RoleController::class, 'update'])
        ->name('dashboard.roles.update');
    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('dashboard.roles.create');

    Route::post('/roles/store', [RoleController::class, 'store'])
        ->name('dashboard.roles.store');

    Route::get('/roles/delete/{role}', [RoleController::class, 'delete'])
        ->name('dashboard.roles.delete');

    Route::post('/roles/action', [RoleController::class, 'action'])
        ->name('dashboard.roles.action');

});*/
