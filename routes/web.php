<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Resource;

use App\Http\Controllers\ResourceController;

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

// Le indicamos a nuestro home que tome el método index del Controlador Resource
Route::get('/', [ResourceController::class, 'index']); 

// // para probar DBsMigrations
// // return \App\Models\Resource::with('category')->get();

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->post('api/resources', function (Request $request) {
    // dd(Category::first());
    Resource::create([
        'title' => $request->title,
        'link' => $request->link,
        'description' => $request->description,
        'category_id' => Category::first()->id,
        'creator_id' => $request->user()->id,
    ]);
});
