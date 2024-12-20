<?php

use App\Http\Controllers\Admin\{AdminController, CategoryController as AdminCategoryController, ProductController as AdminProductController, SubCategoryController as AdminSubCategoryController, CityController as AdminCityController, OrderController as AdminOrderController};
use App\Http\Controllers\{CategoryController, HomeController, ProductsController, ProfileController};
use App\Http\Controllers\Admin\AddonProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['controller' => HomeController::class], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about-us', 'about')->name('about-us');
    Route::get('/contact-us', 'contact')->name('contact-us');
    Route::post('/contact-us', 'storeContact')->name('contact-post');
    Route::get('/terms-and-conditions', 'termsAndConditions')->name('terms-and-conditions');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('/return-and-refund', 'returnAndRefund')->name('return-and-refund');
    Route::get('/disclaimer', 'disclaimer')->name('disclaimer');
    Route::get('/shipping-policy', 'shippingPolicy')->name('shipping-policy');
});

// Category Routes
Route::group(['controller' => CategoryController::class], function () {
    Route::get('/category', 'index')->name('categories');
});

Route::group(['controller' => ProductsController::class], function () {
    Route::get('/category/{category_slug}/{sub_category_slug?}/{city_slug?}/{sort?}', 'show')->name('show-products');
    Route::get('/decoration/{product_slug}', 'detail')->name('decoration-detail');
    Route::post('/get-city', 'getCity')->name('get-city');
    Route::get('/decorations-in/{city_slug}', 'cityDecoration')->name('city-detail');
});

Route::middleware(['auth', 'web'])->group(function () {
    // Admin Controller
    Route::middleware('is-admin')->group(function () {
        Route::group(['prefix' => '/admin', 'controller' => AdminController::class], function () {
            Route::get('/dashboard', 'dashboard')->name('admin-dashboard');
            Route::get('/profile', 'profile')->name('admin-profile');
            Route::get('/contacts', 'contacts')->name('admin-contacts');
            Route::get('/orders', 'orders')->name('admin-orders');
            Route::get('/contact-delete/{id}', 'contactDelete')->name('admin-contact-delete');
            Route::delete('/order-delete/{id}', 'orderDelete')->name('admin-order-delete');
            Route::get('/users-list', 'users')->name('admin-users');
            Route::delete('/user-delete/{id}', 'userDelete')->name('admin-user-delete');
        });

        Route::group(['prefix' => '/admin/category', 'controller' => AdminCategoryController::class], function () {
            Route::get('list', 'index')->name('category-list');
            Route::get('create', 'create')->name('category-create');
            Route::post('create', 'store')->name('category-store');
            Route::get('edit/{id}', 'edit')->name('category-edit');
            Route::patch('edit/{id}', 'update')->name('category-update');
            Route::delete('destroy/{id}', 'destroy')->name('category-destroy');
            Route::get('check-category-slug', 'checkSlug')->name('check-category-slug'); // Check Unique Slug
        });

        Route::group(['prefix' => '/admin/sub-category', 'controller' => AdminSubCategoryController::class], function () {
            Route::get('list', 'index')->name('sub-category-list');
            Route::get('create', 'create')->name('sub-category-create');
            Route::post('create', 'store')->name('sub-category-store');
            Route::get('edit/{id}', 'edit')->name('sub-category-edit');
            Route::patch('edit/{id}', 'update')->name('sub-category-update');
            Route::delete('destroy/{id}', 'destroy')->name('sub-category-destroy');
            Route::get('check-sub-category-slug', 'checkSlug')->name('check-sub-category-slug'); // Check Unique Slug
        });

        Route::group(['prefix' => '/admin/product', 'controller' => AdminProductController::class], function () {
            Route::get('list', 'index')->name('product-list');
            Route::get('create', 'create')->name('product-create');
            Route::get('get-sub-category', 'getSubCategory')->name('get-sub-category');
            Route::get('show/{id}', 'show')->name('product-view');
            Route::post('create', 'store')->name('product-store');
            Route::get('edit/{id}', 'edit')->name('product-edit');
            Route::patch('edit/{id}', 'update')->name('product-update');
            Route::delete('destroy/{id}', 'destroy')->name('product-destroy');
            Route::get('check-product-slug', 'checkSlug')->name('check-product-slug'); // Check Unique Slug
            Route::get('product-img-delete', 'deleteProductImage')->name('product-img-destroy');
        });

        Route::group(['prefix' => '/admin/city', 'controller' => AdminCityController::class], function () {
            Route::get('list', 'index')->name('city-list');
            Route::get('create', 'create')->name('city-create');
            Route::post('create', 'store')->name('city-store');
            Route::get('edit/{id}', 'edit')->name('city-edit');
            Route::patch('edit/{id}', 'update')->name('city-update');
            Route::delete('destroy/{id}', 'destroy')->name('city-destroy');
            Route::get('check-city-slug', 'checkSlug')->name('check-city-slug'); // Check Unique Slug
        });

        Route::group(['prefix' => '/admin/slider', 'controller' => SliderController::class], function () {
            Route::get('list', 'index')->name('slider-list');
            Route::post('create', 'store')->name('slider-store');
            Route::patch('update/{id}', 'update')->name('slider-update');
            Route::delete('destroy/{id}', 'destroy')->name('slider-destroy');
        });

        Route::group(['prefix' => '/admin/addon', 'controller' => AddonProductController::class], function () {
            Route::get('list', 'index')->name('addon-list');
            Route::get('create', 'create')->name('addon-create');
            Route::post('create', 'store')->name('addon-store');
            Route::get('edit/{id}', 'edit')->name('addon-edit');
            Route::patch('edit/{id}', 'update')->name('addon-update');
            Route::delete('destroy/{id}', 'destroy')->name('addon-destroy');
        });

        // Route::group(['prefix' => '/admin/order', 'controller' => AdminOrderController::class], function () {
        //     Route::get('list', 'index')->name('order-list');
        //     Route::get('create', 'create')->name('addon-create');
        //     Route::post('create', 'store')->name('addon-store');
        //     Route::get('edit/{id}', 'edit')->name('addon-edit');
        //     Route::patch('edit/{id}', 'update')->name('addon-update');
        //     Route::delete('destroy/{id}', 'destroy')->name('addon-destroy');
        // });

        Route::group(['prefix' => '/admin/review', 'controller' => ReviewController::class], function () {
            Route::get('list', 'index')->name('review-list');
            Route::get('create', 'create')->name('review-create');
            Route::post('create', 'store')->name('review-store');
            Route::get('edit/{id}', 'edit')->name('review-edit');
            Route::patch('edit/{id}', 'update')->name('review-update');
            Route::delete('destroy/{id}', 'destroy')->name('review-destroy');
        });
    });
    // User Controller
    Route::middleware('is-user')->prefix('user')->group(function () {
        Route::group(['controller' => UserController::class], function () {
            Route::get('/dashboard', 'dashboard')->name('user-dashboard');
            Route::post('/update-rofile', 'updateProfile')->name('user-update-rofile');
            Route::get('/orders', 'orders')->name('user-orders');
            Route::get('/change-passowrd', 'changePassowrd')->name('user-change-passowrd');
            Route::post('/store-order', 'storeOrder')->name('store-order');
            Route::post('/add-item-to', 'addItem')->name('add-item');
            Route::get('/cart-count', 'cartCount')->name('cart-count');
            Route::post('/addon-add', 'addonAdd')->name('addon-add');
            // Route::get('cart', 'cart')->name('cart')->withoutMiddleware(['auth', 'is-user']);

            Route::post('productquantity', 'productquantity')->name('productquantity');
            // Route::post('addonquantity', 'addonquantity')->name('addonquantity');

            Route::get('delete-cart/{id}', 'deleteCart')->name('delete-cart');
            Route::get('delete-addon/{index}/{product_id}', 'deleteAddon')->name('delete-addon')->withoutMiddleware(['auth', 'is-user']);
            
            
            Route::post('write-review', 'review')->name('user-review-add');
            Route::post('review-store', 'reviewStore')->name('user-review-store');

        });
    });
});

Route::group(['controller' => CheckoutController::class, 'middleware' => ['auth', 'is-user', 'prevent-back']], function () {
    Route::post('user/checkout', 'checkout')->name('checkout');
    Route::post('/payment', 'payment')->name('payment');
    Route::get('/checkout/response', 'response')->name('payment.response');
    Route::get('/success', 'success')->name('success');
    Route::get('/failure', 'failure')->name('failure');

});


// Cookie 

Route::controller(CartController::class)->group(function () {
    Route::get('user/cart',  'index')->name('cart');
    
    Route::post('/cart/add',  'store')->name('cart.store');
    Route::post('/cart/update',  'update')->name('cart.update');
    Route::get('/cart/remove/{id}',  'destroy')->name('cart.remove');
    Route::get('/cart/count',  'cartCount')->name('cart.count');
    Route::get('/set-addon',  'setAddonItems')->name('set-addon');
    Route::post('/addonquantity',  'addonquantity')->name('addonquantity');
});

Route::get('user/checkout', function(){
    return redirect()->route('index');
})->middleware('prevent-back');

Route::get('optimize', function () {
    Artisan::call('optimize');
    return "Application optimized.";
});
require __DIR__ . '/auth.php';
