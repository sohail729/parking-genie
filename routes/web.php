<?php

// General
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SpaceController as AdminSpaceController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
// Host
use App\Http\Controllers\Host\DashboardController as HostDashboardController;
use App\Http\Controllers\Host\UserController as HostUserController;
use App\Http\Controllers\Host\SubscriptionController as HostSubscriptionController;
// User
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\GoogleSocialiteController;
use App\Http\Controllers\User\FrontController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\SpaceBookingController;


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

Auth::routes();


Route::get('/admin', function () {
    redirect()->route('admin.dashboard.index');
});

Route::get('/', [HomeController::class, 'index'])->name('front.home');


Route::group(['as' => 'front.'], function () {
    Route::get('choose-a-plan', [UserController::class, 'choosePlan'])->name('choose-a-plan');
    Route::get('signup', [UserController::class, 'showSignup'])->name('signup.show');
    Route::post('check-email', [UserController::class, 'verifyEmail'])->name('check-email');

    Route::post('/process-signup', [UserController::class, 'store'])->name('signup.store');
    Route::get('/signup-success', [UserController::class, 'signupSuccess'])->name('signup.success');
    Route::get('/stripe/reauth', [UserController::class, 'reauth'])->name('space.reauth');
    Route::get('/stripe/return', [UserController::class, 'return'])->name('space.return');
    Route::get('/stripe/refresh-connect', [UserController::class, 'refresh'])->name('space.connect-refresh')->middleware('auth.host');

    Route::get('get-help', [FrontController::class, 'getHelpPage'])->name('help');
    Route::post('contact-form/submit', [FrontController::class, 'submitContact'])->name('contact.submit');
    Route::get('terms-and-conditions', [FrontController::class, 'getTermsPage'])->name('terms-conditions');
    Route::get('privacy-policy', [FrontController::class, 'getPrivacyPage'])->name('privacy-policy');
    Route::get('find-space', [FrontController::class, 'getSpaceListingPage'])->name('find-space');
    Route::get('search-space', [FrontController::class, 'searchSpace'])->name('search-space');
    Route::get('/space/{id}/view', [FrontController::class, 'spacedetail'])->name('space-detail');
    Route::get('get-distance', [FrontController::class, 'getDistance'])->name('get-distance');
});

Route::get('/host', [HostDashboardController::class, 'index'])->name('host.index');
// name current plan date invoice download  next date
Route::post('/login', [AuthController::class, 'login'])->name('user.auth.login');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile/change-password',[AuthController::class, 'showChangePassword'])->name('user.showChangePassword');
    Route::post('/changePassword',[AuthController::class, 'changePassword'])->name('user.changePassword');
});
Route::get('/redirectToStripe',[AuthController::class, 'redirectToStripe'])->name('user.redirectToStripe');
Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle'])->name('google');
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);


Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('categories', CategoryController::class);
    Route::get('/admins/listing', [AdminUserController::class, 'getAdmins'])->name('get-admins');
    Route::get('/hosts/listing', [AdminUserController::class, 'getHosts'])->name('get-hosts');
    Route::get('/customers/listing', [AdminUserController::class, 'getCustomers'])->name('get-customers');
    Route::resource('users', AdminUserController::class);
    Route::resource('plans', PlanController::class);
    Route::get('profile', [SettingsController::class, 'showProfile'])->name('profile.show');
    Route::get('profile/edit', [SettingsController::class, 'editProfile'])->name('profile.edit');
    Route::put('updateProfile', [SettingsController::class, 'updateProfile'])->name('profile.update');

    Route::get('/spaces/available', [AdminSpaceController::class, 'index'])->name('spaces.index');
    Route::get('/spaces/available/{space}', [AdminSpaceController::class, 'show'])->name('space.show');
    Route::get('/space/bookings', [AdminSpaceController::class, 'spaceBookings'])->name('space.bookings.index');
    Route::get('/spaces-by-type', [AdminSpaceController::class, 'spaceByType'])->name('space.by-type');

    Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscription/{subscription}', [AdminSubscriptionController::class, 'show'])->name('subscription.show');
});

Route::group(['middleware' => 'auth.host', 'prefix' => 'host', 'as' => 'host.'], function () {

    Route::get('/dashboard', [HostDashboardController::class, 'dashboard'])->name('dashboard.index');

    Route::get('profile/edit', [HostUserController::class, 'edit'])->name('profile.edit');
    Route::put('updateProfile', [HostUserController::class, 'update'])->name('profile.update');
    Route::get('profile', [SettingsController::class, 'showProfile'])->name('profile.show');


    Route::get('/space/add-new', [HostDashboardController::class, 'spaceCreate'])->name('space.create');
    Route::get('/space/{space}/edit', [HostDashboardController::class, 'spaceEdit'])->name('space.edit');
    Route::get('/spaces', [HostDashboardController::class, 'spaceList'])->name('space.index');
    Route::get('/spaces-by-type', [HostDashboardController::class, 'spaceByType'])->name('space.by-type');
    Route::get('/space/bookings', [HostDashboardController::class, 'spaceBookings'])->name('space.bookings.index');
    Route::post('/store-details', [HostDashboardController::class, 'store'])->name('space.store');
    Route::delete('/delete-image', [HostDashboardController::class, 'deleteImage'])->name('space.delete-image');
    Route::post('/update-details/{id}', [HostDashboardController::class, 'update'])->name('space.update');
    
    Route::get('subscription', [HostSubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('subscription/payment', [HostSubscriptionController::class, 'subsPayment'])->name('subscription.payment');
    Route::get('/cancel-subscription', [HostSubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::post('/new-subscription', [HostSubscriptionController::class, 'newSubscription'])->name('subscription.new');
    
});

Route::group(['middleware' => 'auth.user', 'as' => 'user.'], function () {

    
    Route::get('profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('updateProfile', [UserController::class, 'update'])->name('profile.update');
    Route::get('profile', [SettingsController::class, 'showProfile'])->name('profile.show');

    // Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/store', [UserDashboardController::class, 'storeSpace'])->name('dashboard.store');

    Route::get('/dashboard', [UserDashboardController::class, 'spaceList'])->name('space.bookings.index');
    Route::get('/spaces-by-type', [UserDashboardController::class, 'spaceByType'])->name('space.by-type');


    Route::get('/get-available-slots', [SpaceBookingController::class, 'getTimeSlots'])->name('space.get-time-slots');
    Route::get('/calculate-pricing', [SpaceBookingController::class, 'calPrice'])->name('space.calculate');
    Route::post('/space/process-booking', [SpaceBookingController::class, 'store'])->name('space.store');
});



Route::get('clear-cache', function () {
    Artisan::call('optimize:clear');
    \Request::session()->flash('alert-success', 'System Cache has been cleared!');
    return back();
})->name('clear-cache');
