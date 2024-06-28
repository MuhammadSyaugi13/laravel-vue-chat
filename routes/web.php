<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return Inertia::render('LandingPage');
});

Route::get('/test-page', function () {
    return Inertia::render('TestPage');
});

Route::get('/send-event', function (Request $req) {
    $text = $req->text;
    broadcast(new \App\Events\HelloEvent($text, 1));
});

Route::get('/send-event-2', function (Request $req) {
    $text = $req->text;
    broadcast(new \App\Events\HelloEvent($text, 2));
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix("chat")->name("chat.")->group(function () {
        Route::get("/", [ChatController::class, "index"])->name("index");
        Route::post("/save", [ChatController::class, "saveMessage"])->name("save");
        Route::get("/load", [ChatController::class, "loadMessage"])->name("load");
    });
});

require __DIR__.'/auth.php';
