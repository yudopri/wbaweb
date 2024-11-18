<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ArticleController;

// Authentication routes with email verification enabled
Auth::routes(['verify' => true]);

// Homepage route
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication routes
Route::get('admin/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('admin/', [AuthController::class, 'login']);


// Static page routes
Route::view('/tentang', 'tentang_kami')->name('tentang-kami');
Route::view('/layanan', 'layanan')->name('layanan');
Route::view('/programkerja', 'program_kerja')->name('program-kerja');
Route::view('/fasilitas', 'fasilitas')->name('fasilitas');
Route::view('/client', 'client')->name('our-clients');
Route::view('/karir', 'karir')->name('karir');
Route::view('/gallery', 'gallery')->name('gallery');
Route::view('/kontak', 'kontak_kami')->name('kontak-kami');
Route::resource('article', ArticleController::class);
Route::get('/article', [ArticleController::class, 'showUser'])->name('article');

// Admin routes with authentication and email verification middleware
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard route - only accessible to verified users
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Jasa management routes
    Route::resource('service', ServiceController::class);
Route::get('/service', [ServiceController::class, 'index'])->name('admin.service.index');
Route::get('/service/create', [ServiceController::class, 'create'])->name('admin.service.create');
Route::put('/service/{service}', [ServiceController::class, 'update'])->name('admin.service.update');
Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('admin.service.edit'); // Corrected route
Route::post('/service/store', [ServiceController::class, 'store'])->name('admin.service.store');
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('admin.service.destroy');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('admin.service.show');

// In web.php (routes file)
Route::get('storage/{file}', function ($file) {
    $path = storage_path('app/' . $file);

    if (file_exists($path)) {
        return response()->file($path);
    }

    abort(404);
})->name('storage.file');

    // Partner management routes
    Route::resource('partner', PartnerController::class);

Route::get('/partner', [PartnerController::class, 'index'])->name('admin.partner.index');
Route::get('/partner/create', [PartnerController::class, 'create'])->name('admin.partner.create');
Route::put('/partner/{partner}', [PartnerController::class, 'update'])->name('admin.partner.update');
Route::get('/partner/edit/{id}', [PartnerController::class, 'edit'])->name('admin.partner.edit'); // Corrected route
Route::post('/partner/store', [PartnerController::class, 'store'])->name('admin.partner.store');
Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('admin.partner.destroy');
Route::get('/partners/{id}', [PartnerController::class, 'show'])->name('admin.partner.show');

    // Email verification routes (handled by Auth::routes(['verify' => true]))
    // These are only needed if you have custom logic; otherwise, they're covered by Auth::routes(['verify' => true])
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('auth')->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->middleware('auth')->name('verification.resend');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('article', ArticleController::class);
Route::get('/article', [ArticleController::class, 'index'])->name('admin.article.index');
Route::get('/article/create', [ArticleController::class, 'create'])->name('admin.article.create');
Route::put('/article/{article}', [ArticleController::class, 'update'])->name('admin.article.update');
Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('admin.article.edit');
Route::post('/article/store', [ArticleController::class, 'store'])->name('admin.article.store');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('admin.article.destroy');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('admin.article.show');
});

// Visitor cookie route
Route::get('/set-visitor-cookie', [VisitorController::class, 'setVisitorCookie']);

// Default home route, only used if needed
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');