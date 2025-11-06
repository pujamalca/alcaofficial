<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PostPreviewController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SourceCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Fetch active database content for homepage sections
    $services = \App\Models\Service::active()->get();
    $portfolios = \App\Models\PortfolioItem::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
    $pricingPlans = \App\Models\PricingPlan::active()
        ->with('features')
        ->get();
    $sourceCodes = \App\Models\SourceCode::active()
        ->ordered()
        ->limit(6)
        ->get();
    $testimonials = \App\Models\Testimonial::active()->get();
    $contactCards = \App\Models\ContactCard::active()->get();

    $projectCount = $portfolios->count();
    $happyClientsCount = $testimonials->count();
    $averageRatingRaw = $testimonials->avg('rating');
    $averageRating = $averageRatingRaw ? round($averageRatingRaw, 1) : 0;
    $satisfactionPercent = $averageRating > 0
        ? min(100, max(0, round(($averageRating / 5) * 100)))
        : 0;

    return view('welcome', [
        'services' => $services,
        'portfolios' => $portfolios,
        'pricingPlans' => $pricingPlans,
        'sourceCodes' => $sourceCodes,
        'testimonials' => $testimonials,
        'contactCards' => $contactCards,
        'heroStats' => [
            'projects' => $projectCount,
            'clients' => $happyClientsCount,
            'rating' => $averageRating,
            'satisfaction' => $satisfactionPercent,
        ],
    ]);
});

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Services routes
Route::get('/layanan', [ServicesController::class, 'index'])->name('services.index');
Route::get('/layanan/{service:slug}', [ServicesController::class, 'show'])->name('services.show');

// Source code routes
Route::get('/source-code', [SourceCodeController::class, 'index'])->name('source-codes.index');
Route::get('/source-code/{sourceCode:slug}', [SourceCodeController::class, 'show'])->name('source-codes.show');

// Portfolio routes
Route::get('/portofolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portofolio/{portfolioItem:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Pages routes
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

// Guest Routes (Registration & Password Reset)
Route::middleware('guest')->group(function () {
    // Registration
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // Password Reset
    Route::get('/forgot-password', [PasswordResetController::class, 'request'])
        ->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'email'])
        ->middleware('throttle:6,1')
        ->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])
        ->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])
        ->name('password.update');
});

// Email Verification Routes (Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/email/resend', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.resend');
});

// Preview routes (protected with auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/preview/posts/{post}', [PostPreviewController::class, 'show'])->name('posts.preview');
    Route::get('/preview/pages/{page}', [PageController::class, 'preview'])->name('pages.preview');
});

