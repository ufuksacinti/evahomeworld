<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Collection Routes
Route::get('/koleksiyonlar', [CollectionController::class, 'index'])->name('collections.index');
Route::get('/koleksiyon/{slug}', [CollectionController::class, 'show'])->name('collections.show');

// Product Routes
Route::get('/urunler', [ProductController::class, 'index'])->name('products.index');
Route::get('/urunler/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/kategori/{slug}', [ProductController::class, 'category'])->name('category.show');

// Cart Routes
Route::get('/sepet', [CartController::class, 'index'])->name('cart.index');
Route::post('/sepet/ekle/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/sepet/guncelle/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/sepet/sil/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/sepet/temizle', [CartController::class, 'clear'])->name('cart.clear');

// Checkout Routes
Route::middleware('auth')->group(function () {
    Route::get('/odeme', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/siparis-olustur', [CartController::class, 'processOrder'])->name('order.process');
    
    // Favorites
    Route::get('/favoriler', [ProductController::class, 'favorites'])->name('favorites.index');
    Route::post('/favori/ekle/{product}', [ProductController::class, 'addToFavorites'])->name('favorites.add');
    Route::delete('/favori/sil/{product}', [ProductController::class, 'removeFromFavorites'])->name('favorites.remove');
    
    // My Orders
    Route::get('/siparislerim', [CartController::class, 'myOrders'])->name('my.orders');
    Route::get('/siparis/{order}', [CartController::class, 'orderDetail'])->name('order.detail');
});

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/kategori/{slug}', [BlogController::class, 'category'])->name('blog.category');

// Static Pages
Route::get('/hakkimizda', [HomeController::class, 'about'])->name('about');
Route::get('/iletisim', [HomeController::class, 'contact'])->name('contact');
Route::post('/iletisim', [HomeController::class, 'sendContact'])->name('contact.send');

// Bulk Order
Route::get('/toplu-siparis', [HomeController::class, 'bulkOrder'])->name('bulk.order');
Route::post('/toplu-siparis', [HomeController::class, 'submitBulkOrder'])->name('bulk.order.submit');

// User Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products Management
    Route::resource('products', AdminProductController::class);
    Route::post('products/{product}/images', [AdminProductController::class, 'uploadImages'])->name('products.images');
    Route::delete('products/{product}/images/{image}', [AdminProductController::class, 'deleteImage'])->name('products.images.delete');
    
    // Collections Management
    Route::resource('collections', \App\Http\Controllers\Admin\CollectionController::class);
    
    // Categories Management
    Route::resource('categories', AdminCategoryController::class);
    
    // Orders Management
    Route::resource('orders', AdminOrderController::class);
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    
    // Customers Management
    Route::get('/customers', [DashboardController::class, 'customers'])->name('customers.index');
    Route::get('/customers/{user}', [DashboardController::class, 'customerShow'])->name('customers.show');
    
    // Bulk Orders Management
    Route::get('/bulk-orders', [DashboardController::class, 'bulkOrders'])->name('bulk-orders.index');
    Route::patch('/bulk-orders/{bulkOrder}/status', [DashboardController::class, 'updateBulkOrderStatus'])->name('bulk-orders.status');
    
    // Blog Posts Management
    Route::resource('blog-posts', AdminBlogPostController::class);
    Route::post('blog-posts/{blogPost}/publish', [AdminBlogPostController::class, 'publish'])->name('blog-posts.publish');
    
    // Settings
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::post('/settings', [DashboardController::class, 'updateSettings'])->name('settings.update');
});

require __DIR__.'/auth.php';
