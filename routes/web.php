<?php

use Illuminate\Support\Facades\Route;

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
use App\Models\Category;
use App\Models\CmsPage;

require __DIR__.'/auth.php';

Route::prefix('/admin')->namespace('App\\Http\\Controllers\\Admin')->group(function(){
    // All Admin Routes:-
    Route::match(['get','post'],'/','AdminController@login');

    Route::group(['middleware'=>['admin']],function(){

        //Admin
        Route::get('dashboard','AdminController@dashboard');
        Route::get('settings','AdminController@settings');
        Route::get('logout','AdminController@logout');
        Route::post('check-current-pwd','AdminController@chkCurrentPassword');
        Route::post('update-current-pwd','AdminController@updateCurrentPassword');
        Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');

        //Sections
        Route::get('sections','SectionController@sections');
        Route::post('update-section-status','SectionController@updateSectionStatus');
        Route::match(['get','post'],'add-edit-section/{id?}','SectionController@addEditSection');
        Route::get('delete-section-image/{id}','SectionController@deleteSectionImage');
        Route::get('delete-section/{id}','SectionController@deleteSection');
    
        // Brands
        Route::get('brands','BrandController@brands');
        Route::post('update-brand-status','BrandController@updateBrandStatus');
        Route::match(['get','post'],'add-edit-brand/{id?}','BrandController@addEditBrand');
        Route::get('delete-brand/{id}','BrandController@deleteBrand');

        // Categories
        Route::get('categories','CategoryController@categories');
        Route::post('update-category-status','CategoryController@updateCategoryStatus');
        Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');
        Route::post('append-categories-level','CategoryController@appendCategoryLevel');
        Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}','CategoryController@deleteCategory');

        //Products
        Route::get('products','ProductsController@products');
        Route::post('update-product-status','ProductsController@updateProductStatus');
        Route::get('delete-product/{id}','ProductsController@deleteProduct');
        Route::match(['get','post'],'add-edit-product/{id?}','ProductsController@addEditProduct');
        Route::get('delete-product-image/{id}','ProductsController@deleteProductImage');
        Route::get('delete-product-video/{id}','ProductsController@deleteProductVideo');

        //Product Attributes
        Route::match(['get','post'],'add-attributes/{id}','ProductsController@addAttributes');
        Route::post('edit-attributes/{id}','ProductsController@editAttributes');
        Route::post('update-attribute-status','ProductsController@updateAttributeStatus');
        Route::get('delete-attribute/{id}','ProductsController@deleteAttribute');

        // Product Images
        Route::match(['get','post'],'add-images/{id}','ProductsController@addImages');
        Route::post('update-image-status','ProductsController@updateImageStatus');
        Route::get('delete-image/{id}','ProductsController@deleteImage');

        // Banners
        Route::get('banners','BannerController@banners');
        Route::match(['get','post'],'add-edit-banner/{id?}','BannerController@addEditBanner');
        Route::post('update-banner-status','BannerController@updateBannerStatus');
        Route::get('delete-banner/{id}','BannerController@deleteBanner');
        Route::get('delete-banner-image/{id}','BannerController@deleteBannerImage');

        // Orders
        Route::get('orders','OrdersController@orders');
        Route::get('orders/{id}','OrdersController@orderDetails');
        Route::post('update-order-status','OrdersController@updateOrderStatus');
        Route::get('view-order-invoice/{id}','OrdersController@viewOrderInvoice');

        // Coupons
        Route::get('coupons','CouponsController@coupons');
        Route::match(['get','post'],'add-edit-coupon/{id?}','CouponsController@addEditCoupon');
        Route::post('update-coupon-status','CouponsController@updateCouponStatus');
        Route::get('delete-coupon/{id}','CouponsController@deleteCoupon');

        // Shipping Charges
        Route::get('view-shipping-charges','ShippingController@viewShippingCharges');
        Route::match(['get','post'],'edit-shipping-charges/{id}','ShippingController@editShippingCharges');
        Route::post('update-shipping-status','ShippingController@updateShippingStatus');

        // Users
        Route::get('users','UsersController@users');

        // CMS Pages
        Route::get('cms-pages','CmsController@cmspages');
        Route::post('update-cms-page-status','CmsController@updateCmsPageStatus');
        Route::match(['get','post'],'add-edit-cms-page/{id?}','CmsController@addEditCmsPage');
        Route::get('delete-page/{id}','CmsController@deleteCmsPage');

        // Cart Other Settings
        Route::match(['get','post'],'update-other-settings','CartController@UpdateOtherSettings');

        // Rating Route
        Route::get('ratings','RatingsController@ratings');
        Route::post('update-rating-status','RatingsController@updateRatingStatus');

    }); 

});

Route::namespace('App\\Http\\Controllers\\Front')->group(function(){
    // Home Page Route
    Route::get('/','IndexController@index');

    // Listing Page Route
    $catUrls = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
    foreach ($catUrls as $url) {
        Route::get('/'.$url,'ProductsController@listing');
    }

    // Cms Pages
    $cmsUrls = CmsPage::select('url')->where('status',1)->get()->pluck('url')->toArray();
    foreach ($cmsUrls as $url) {
        Route::get('/'.$url,'CmsController@cmsPage');
    }

    // Product Detail Page
    Route::get('/product/{id}','ProductsController@detail');
     
    //Get Product Attribute Price
    Route::post('/get-product-price','ProductsController@getProductPrice');

    // Add To Cart Route
    Route::post('/add-to-cart','ProductsController@addtocart');
    
    // Shopping Cart Page Route
    Route::get('/cart','ProductsController@cart') ;
    
    // Update Cart Item Quantity
    Route::post('/update-cart-item-qty','ProductsController@updateCartItemQty');

    //Delete Cart Item
    Route::post('/delete-cart-item','ProductsController@deleteCartItem');

    // User Login/Register Route

    // Login/Register Page    
    Route::get('/login-register',['as'=>'login','uses'=>'UsersController@loginRegister']);

    // Login User
    Route::post('/login','UsersController@loginUser');

    // Register User
    Route::post('/register','UsersController@registerUser');
    Route::match(['get','post'],'/check-email','UsersController@checkEmail');

    // Logout User
    Route::get('/logout','UsersController@logoutUser');

    // Confirm Account
    Route::match(['GET','POST'],'/confirm/{code}','UsersController@confirmAccount');

    // Forgot Password 
    Route::match(['GET','POST'],'/forgot-password','UsersController@forgotPassword');

    // Product Detail Page Pincode Check
    Route::post('/check-pincode','ProductsController@checkPincode');

    // Search Route
    Route::get('/search-products','ProductsController@listing');

    // Contact Us Page
    Route::match(['GET','POST'],'/contact','CmsController@contact');    

    // Rating & Review
    Route::match(['GET','POST'],'/add-rating','RatingsController@addRating'); 

    // Protected Route
    Route::group(['middleware'=>['auth']],function(){
        
        // USER ACCOUNT ROUTES
        Route::prefix('/account')->group(function () {

            // User MY Account or Profile Page
            Route::match(['GET','POST'],'/','UsersController@account');

            // Users Order
            Route::get('/orders','OrdersController@orders');
            Route::get('/orders{id}','OrdersController@orderDetails');


            // User Profile Edit
            Route::match(['GET','POST'],'/edit-profile','UsersController@edit_profile');
            
                // Change Password Page
                Route::get('/change-password','UsersController@ChangeUserPwd');
                
                // Check User Curent Password
                Route::post('/check-user-pwd','UsersController@chkUserPassword');
                
                // Update User Update
                Route::post('/update-user-pwd','UsersController@updateUserPassword');

                // Deliver Address Book
                Route::get('/address-book','UsersController@addressBook');

        });

        // Apply Coupon
        Route::post('/apply-coupon','ProductsController@applyCoupon');

        // Checkout
        Route::match(['GET','POST'],'/checkout','CheckoutController@checkout');

        // Order Placed Page
        Route::get('/thanks','CheckoutController@thanks');


        // Delivery Address

        // Add/Edit Delivery Address
        Route::match(['get','post'],'/add-edit-delivery-address/{id?}',
        'DeliveryAddressController@addEditDeliveryAddress');

        // Delete Delivery Address
        Route::get('/delete-delivery-address/{id}','DeliveryAddressController@deleteDeliveryAddress');

        Route::post('autofill-address','DeliveryAddressController@autofillAddress');


    });

}); 