<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentController;

Route::get('/', [FrontendController::class, 'home'])->name('landing');
Route::get('/courses', [FrontendController::class, 'courses'])->name('courses.index');
Route::get('/courses/{course:slug}', [FrontendController::class, 'course'])->name('courses.show');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [FrontendController::class, 'terms'])->name('terms');
Route::get('/refund-policy', [FrontendController::class, 'refund'])->name('refund');
Route::get('/certificate/verify', [FrontendController::class, 'verify'])->name('certificates.verify');
Route::get('/enquiry', [EnquiryController::class, 'create'])->name('enquiry.create');
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');

Route::get('/home', function () {
    $route = auth()->user()?->is_admin ? 'admin.home' : 'student.dashboard';

    if (session('status')) {
        return redirect()->route($route)->with('status', session('status'));
    }

    return redirect()->route($route);
})->middleware('auth');
 
Auth::routes();

Route::group(['prefix' => 'student', 'as' => 'student.', 'middleware' => ['auth', 'student.panel']], function () {
    Route::get('/', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [StudentProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [StudentProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [StudentProfileController::class, 'password'])->name('profile.password');
    Route::post('courses/{course:slug}/enroll', [StudentController::class, 'enroll'])->name('courses.enroll');
    Route::get('courses/{course:slug}/checkout', [PaymentController::class, 'checkout'])->name('courses.checkout');
    Route::post('courses/{course:slug}/payment-success', [PaymentController::class, 'success'])->name('courses.payment-success');
    Route::get('learn/{enrollment}', [StudentController::class, 'learn'])->name('learn');
    Route::post('learn/{enrollment}/complete', [StudentController::class, 'complete'])->name('learn.complete');
    Route::get('certificates/{certificate}', [StudentController::class, 'certificate'])->name('certificates.show');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin.panel']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('courses', 'CoursesController');
    Route::resource('enrollments', 'EnrollmentsController')->except(['show']);
    Route::resource('enquiries', 'EnquiriesController')->only(['index', 'update', 'destroy']);
    Route::get('settings', 'SiteSettingsController@edit')->name('settings.edit');
    Route::put('settings', 'SiteSettingsController@update')->name('settings.update');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
