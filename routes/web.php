<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\admin\TypeController;
use App\Http\Controllers\ProfileController;
use App\Models\Project;
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
    $projects = Project::all();
    return view('public.index', compact('projects'));
});



Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function () {
    Route::get('/', [DashboardController::class, 'main'])->name('dashboard');
    
    // Rotte protette
    Route::resource('projects', ProjectController::class);
    Route::resource('types', TypeController::class);
    Route::resource('technologies', TechnologyController::class);
}); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
