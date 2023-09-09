<?php

use App\Http\Controllers\CategoryContentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TintucController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

Route::get('/', function () {
    return redirect('/index');
});

Route::get('/dashboard', function () {
    return Inertia::render('DashBoard');
})->middleware(['auth'])->name('dashboard');
Route::get(
    'index',
    [LandingPageController::class, 'index']
);
Route::get(
    'news',
    [LandingPageController::class, 'tintuc']
);
Route::get(
    'visualization',
    [LandingPageController::class, 'visualization']
);

Route::get(
    'virtual-reality',
    [LandingPageController::class, 'virtual_reality']
);
Route::get(
    'contact',
    [LandingPageController::class, 'contact']
);
Route::get(
    'new/{slug}',
    [LandingPageController::class, 'chitiet_tintuc']
)->name('new.detail');

Route::get(
    'content/{slug}',
    [LandingPageController::class, 'chitiet_content_tintuc']
)->name('content.detail');

Route::get(
    'product/{slug}',
    [LandingPageController::class, 'visualization_preview']
)->name('product.preview');

Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('contact/success', [ContactController::class, 'success']);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(['prefix' => 'mails'], function () {
        Route::get('', [MailController::class, 'index'])->name('mail.index');
        Route::post('', [MailController::class, 'store'])->name('mail.store');
        Route::put('update/{id}', [MailController::class, 'update'])->name('mail.update');
        Route::delete('delete/{id}', [MailController::class, 'delete'])->name('mail.delete');
        Route::get('previewMail/{id}', [MailController::class, 'previewMail'])->name('mail.previewMail');
        Route::put('sendMail/{id}', [MailController::class, 'sendMail'])->name('mail.sendMail');
    });
    Route::group(['prefix' => 'contacts'], function () {
        Route::get('', [ContactController::class, 'index'])->name('contact.index');
    });

    Route::group(['prefix' => 'admin/blogs'], function () {

        Route::group(['prefix' => 'theloai'], function () {
            Route::get('', [TheLoaiController::class, 'index'])->name('theloai.index');
            Route::post('', [TheLoaiController::class, 'store'])->name('theloai.store');
            Route::put('update/{id}', [TheLoaiController::class, 'update'])->name('theloai.update');
            Route::delete('delete/{id}', [TheLoaiController::class, 'delete'])->name('theloai.delete');
        });
        Route::group(['prefix' => 'tags'], function () {
            Route::get('', [TagController::class, 'index'])->name('tag.index');
            Route::post('', [TagController::class, 'store'])->name('tag.store');
            Route::put('update/{id}', [TagController::class, 'update'])->name('tag.update');
            Route::delete('delete/{id}', [TagController::class, 'delete'])->name('tag.delete');
        });
        Route::group(['prefix' => 'tintuc'], function () {
            Route::get('', [TintucController::class, 'index'])->name('tintuc.index');
            Route::get('create', [TintucController::class, 'create'])->name('tintuc.create');
            Route::get('edit/{id}', [TintucController::class, 'edit'])->name('tintuc.edit');
            Route::post('', [TintucController::class, 'store'])->name('tintuc.store');
            Route::post('update/{id}', [TintucController::class, 'update'])->name('tintuc.update');
            Route::delete('delete/{id}', [TintucController::class, 'delete'])->name('tintuc.delete');
        });
    });
    Route::group(['prefix' => 'admin/languages'], function () {
        Route::get('', [LanguageController::class, 'index'])->name('languages');
        Route::post('store', [LanguageController::class, 'store'])->name('languages.store');
        Route::put('update/{id}', [LanguageController::class, 'update'])->name('languages.update');
        Route::delete('delete/{id}', [LanguageController::class, 'delete'])->name('languages.delete');
    });
    Route::group(['prefix' => 'admin/pages'], function () {
        Route::get('', [PageController::class, 'index'])->name('pages');
        Route::post('', [PageController::class, 'store'])->name('pages.store');
        Route::put('/update/{id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/delete/{id}', [PageController::class, 'delete'])->name('pages.delete');
        Route::post('priorityPage', [PageController::class, 'priorityPage'])->name('pages.priority');
        Route::group(['prefix' => '{id}/section'], function () {
            Route::get('', [SectionController::class, 'index'])->name('section.index');
            Route::get('create', [SectionController::class, 'create'])->name('section.create');
            Route::get('edit', [SectionController::class, 'edit'])->name('section.edit');
            Route::post('', [SectionController::class, 'store'])->name('section.store');
            Route::put('update', [SectionController::class, 'update'])->name('section.update');
            Route::delete('delete', [SectionController::class, 'delete'])->name('section.delete');
        });
        Route::group(['prefix' => 'section/{slug}/content'], function () {
            Route::get('', [ContentController::class, 'index'])->name('content.index');
            Route::get('create', [ContentController::class, 'createContent'])->name('content.create');
        });
        Route::group(['prefix' => 'section/{id}/content'], function () {
            Route::post('store', [ContentController::class, 'store'])->name('content.store');
            Route::get('edit', [ContentController::class, 'edit'])->name('content.edit');
            Route::post('update', [ContentController::class, 'update'])->name('content.update');
            Route::delete('delete', [ContentController::class, 'delete'])->name('content.delete');
            Route::post('category_store', [ContentController::class, 'category_store'])->name('content.category_store');
            Route::get('/images', [ImageController::class, 'list_image'])->name('image.index');
        });

        Route::group(['prefix' => 'section/{slug}/category'], function () {
            Route::get('', [CategoryContentController::class, 'category'])->name('category.index');
            Route::get('contents', [CategoryContentController::class, 'category_getContent'])->name('category.contents');
            Route::get('contents/create', [CategoryContentController::class, 'createContentCategory'])->name('category.create-content');
        });


        Route::group(['prefix' => 'section/{id}/category'], function () {
            Route::post('store', [CategoryContentController::class, 'store'])->name('category.store');
            Route::get('edit', [CategoryContentController::class, 'editContentCategory'])->name('category.edit-content');
            Route::put('update', [CategoryContentController::class, 'update'])->name('category.update');
            Route::delete('delete', [CategoryContentController::class, 'delete'])->name('category.delete');
        });
        Route::post('image/selectElement', [ImageController::class, 'selectElement']);
        Route::post('image/selectEmbed', [ImageController::class, 'selectEmbed']);

        Route::group(['prefix' => 'images/{id}'], function () {
            Route::post('store', [ImageController::class, 'store'])->name('image.store');



            Route::post('update', [ImageController::class, 'update'])->name('image.update');
            Route::delete('delete', [ImageController::class, 'delete'])->name('image.delete');
        });
        Route::post(
            'image/priority',
            [ImageController::class, 'priorityImage']
        )->name('image.priority');

        Route::post(
            'section/priority',
            [SectionController::class, 'prioritySection']
        )->name('section.priority');
        Route::post(
            'content/priority',
            [ContentController::class, 'priorityContent']
        )->name('content.priority');
    });
    Route::group(['prefix' => 'admin/themes'], function () {
        Route::get('', [ThemeController::class, 'index'])->name('themes.index');
        Route::post('', [ThemeController::class, 'store'])->name('themes.store');
        Route::post('update/{id}', [ThemeController::class, 'update'])->name('themes.update');
        Route::delete('delete/{id}', [ThemeController::class, 'delete'])->name('themes.delete');
    });
    Route::get('admin/content-visual-reality', [ContentController::class, 'all'])->name('content.visual-reality');

    Route::post('changeActiveSection', [SectionController::class, 'changeActive'])->name('section.changeActive');
});
Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);

    return redirect()->back();
})->name('language');
require __DIR__ . '/auth.php';
