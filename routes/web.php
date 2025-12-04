<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;

Route::get('/', function () {
    if (Auth::check()) {
        // Jika SUDAH login → langsung ke daftar asset
        return redirect()->route('assets.index');
    }

    // Jika BELUM login → tetap ke halaman login
    return view('auth.home', ['mode' => 'login']);
});



Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);




Route::middleware('auth')->group(function () {
    //asset
    Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
    Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
    Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
    Route::get('/assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit');
    Route::put('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');
    Route::get('/assets/{asset}', [AssetController::class, 'show'])->name('assets.show');
    //profil
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    //logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});