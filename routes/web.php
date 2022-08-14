<?php

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShareContactController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware("auth")->group(function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource("/contact",ContactController::class);
    Route::resource("/share-contact",ShareContactController::class);

    Route::get("/contact/delete/{id}",[ContactController::class,'delete'])->name("contact.delete");
    Route::delete('contact/forceDelete/{id}',[ContactController::class,'forceDelete'])->name('contact.forceDelete');
    Route::get('contact/restore/{id}',[ContactController::class,'restore'])->name('contact.restore');

    Route::get('/trash',[HomeController::class,'trash'])->name('trash');
    Route::delete('/trash-bulk-action',[HomeController::class,'trashBulkAction'])->name('trashBulkAction');

    Route::post("/contact-bulk-action",[ContactController::class,'bulkAction'])->name("contact.bulkAction");
    Route::post("/contact-bulk-share",[ContactController::class,'bulkShare'])->name("contact.bulkShare");
    Route::post("/contact-share",[ContactController::class,'contactShare'])->name("contact.contactShare");


    Route::get("/language/{locale}",[\App\Http\Controllers\LanguageController::class,'change'])->name('language.change');
});

