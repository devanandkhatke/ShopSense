<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Auth Common Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return app(\App\Http\Middleware\RoleRedirect::class)
            ->handle(request(), fn() => null);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SellerApprovalController;
use App\Http\Controllers\Admin\ActiveSellerController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\PayoutController as AdminPayoutController;
use App\Http\Controllers\Admin\SellerKycReviewController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;

Route::middleware(['auth', 'role:super-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

        /* ===== Profile ===== */
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

        /* ===== Seller Applications ===== */
        Route::get('/sellers', [SellerApprovalController::class, 'index'])->name('sellers.index');
        Route::post('/sellers/{seller}/approve', [SellerApprovalController::class, 'approve'])->name('sellers.approve');
        Route::post('/sellers/{seller}/reject', [SellerApprovalController::class, 'reject'])->name('sellers.reject');
        Route::get('/sellers/active', [ActiveSellerController::class, 'index'])->name('sellers.active');
        Route::get('/sellers/{seller}', [SellerApprovalController::class, 'show'])->name('sellers.show');

        /* ===== Seller KYC (FIXED) ===== */
        Route::get('/kyc', [SellerKycReviewController::class, 'index'])->name('kyc.index');
        Route::get('/kyc/{seller}', [SellerKycReviewController::class, 'show'])->name('kyc.show');

        Route::post('/kyc/{kyc}/approve', [SellerKycReviewController::class, 'approve'])
            ->name('kyc.approve');

        Route::post('/kyc/{kyc}/reject', [SellerKycReviewController::class, 'reject'])
            ->name('kyc.reject');

        /* ===== Product Moderation ===== */
        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::post('/products/{product}/approve', [AdminProductController::class, 'approve'])->name('products.approve');
        Route::post('/products/{product}/reject', [AdminProductController::class, 'reject'])->name('products.reject');
        Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show');

        /* ===== Categories ===== */
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

        /* ===== Attributes ===== */
        Route::get('/attributes', [AttributeController::class, 'index'])->name('attributes.index');
        Route::post('/attributes', [AttributeController::class, 'store'])->name('attributes.store');
        Route::get('/attributes/{attribute}/edit', [AttributeController::class, 'edit'])->name('attributes.edit');
        Route::put('/attributes/{attribute}', [AttributeController::class, 'update'])->name('attributes.update');
        Route::post('/attributes/{attribute}/values', [AttributeValueController::class, 'store'])->name('attributes.values.store');
        Route::delete('/attribute-values/{value}', [AttributeValueController::class, 'destroy'])->name('attributes.values.destroy');

        /* ===== Payouts ===== */
        Route::get('/payouts', [AdminPayoutController::class, 'index'])->name('payouts.index');
        Route::post('/payouts/{payout}/paid', [AdminPayoutController::class, 'markPaid'])->name('payouts.paid');
    });

/*
|--------------------------------------------------------------------------
| SELLER ROUTES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Seller\DashboardController as SellerDashboard;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\ProductImageController;
use App\Http\Controllers\Seller\ProductVariantController;
use App\Http\Controllers\Seller\ProfileController as SellerProfileController;
use App\Http\Controllers\Seller\SellerKycController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Http\Controllers\Seller\BankAccountController;
use App\Http\Controllers\Seller\PayoutController as SellerPayoutController;

Route::middleware(['auth', 'role:seller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        Route::get('/', [SellerDashboard::class, 'index'])->name('dashboard');

        Route::get('/profile', [SellerProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [SellerProfileController::class, 'update'])->name('profile.update');

        Route::get('/kyc', [SellerKycController::class, 'edit'])->name('kyc.edit');
        Route::post('/kyc', [SellerKycController::class, 'update'])->name('kyc.update');

        Route::get('/store-setup', [SellerStoreController::class, 'edit'])->name('store.edit');
        Route::post('/store-setup', [SellerStoreController::class, 'update'])->name('store.update');

        Route::middleware('seller.kyc')->group(function () {

            Route::get('/bank', [BankAccountController::class, 'edit'])->name('bank.edit');
            Route::post('/bank', [BankAccountController::class, 'update'])->name('bank.update');

            Route::get('/payouts', [SellerPayoutController::class, 'index'])->name('payout.index');
            Route::post('/payouts', [SellerPayoutController::class, 'request'])->name('payout.request');

            Route::prefix('products')->name('products.')->group(function () {

                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/', [ProductController::class, 'store'])->name('store');
                Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('/{product}', [ProductController::class, 'update'])->name('update');
                Route::post('/{product}/images', [ProductImageController::class, 'store'])->name('images.store');
                Route::delete('/images/{image}', [ProductImageController::class, 'destroy'])->name('images.destroy');
                Route::get('/{product}/variants', [ProductVariantController::class, 'index'])->name('variants.index');
                Route::post('/{product}/variants', [ProductVariantController::class, 'store'])->name('variants.store');
            });
        });
    });

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Seller\SellerOnboardingController;

Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/customer', [CustomerDashboard::class, 'index'])->name('customer.dashboard');

    Route::get('/seller/apply', [SellerOnboardingController::class, 'create'])->name('seller.apply');
    Route::post('/seller/apply', [SellerOnboardingController::class, 'store'])->name('seller.apply.store');

    Route::get('/seller/pending', fn() => view('seller.pending'))->name('seller.pending');
});
