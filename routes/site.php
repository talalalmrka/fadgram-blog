<?php

use App\Http\Controllers\Pdf\PdfController;
use App\Http\Controllers\Site\Home\HomeController;
use App\Http\Controllers\Site\Posts\PostController;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/blog', [PostController::class, 'index'])->name('site.posts');
Route::get('/blog/{post:slug}', [PostController::class, 'single'])->name('site.post');
Route::get('/blog/{post:slug}/data', [PostController::class, 'data'])->name('site.post.data');
Route::get('pdf-viewer', [PdfController::class, 'index'])->name('pdf_viewer');
Route::get('/media/dump', function () {
    $media = Media::all();
    dd($media->toArray());
});
