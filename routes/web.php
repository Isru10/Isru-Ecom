<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SPostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// POSTS
Route::group(['middleware'=>'auth'],function(){
    Route::get('spost/trash',[SPostController::class,'trashed'])->name('spost.trashed');
    Route::get('spost/{id}/restore',[SPostController::class,'restore'])->name('spost.restore');
    Route::delete('spost/{id}/force-delete',[SPostController::class,'forceDelete'])->name('spost.force_delete');
    Route::resource('spost',SPostController::class);

});

Route::get('user-data', function () {
    return Auth::user();
});

require __DIR__.'/auth.php';
