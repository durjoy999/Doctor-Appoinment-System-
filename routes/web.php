<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AwardsRecordController;
use App\Http\Controllers\Admin\ConfigSettingsController;
use App\Http\Controllers\Admin\DoctorMyselfController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\DoctorPhotoController;
use App\Http\Controllers\Admin\EducationalQualificationController;
use App\Http\Controllers\Admin\MakeAnAppointmentController;
use App\Http\Controllers\Admin\ScheduleHospitalController;
use App\Http\Controllers\Admin\WhichHospitalController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes(['verify' => true]);
/**
 * Frontend route start
 */
Route::middleware('xssSanitizer')->as('frontend.')->group(function () {
    /**
     * Guest route with web guard start
     */
    Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('homee');
    Route::post('/makeAppointment/store', [App\Http\Controllers\Frontend\HomeController::class, 'store'])->name('store');
    Route::get('/Appointment', [App\Http\Controllers\Frontend\HomeController::class,'Appointment'])->name('Appointment');
    Route::get('/WhichHospital', [App\Http\Controllers\Frontend\HomeController::class, 'WhichHospital'])->name('WhichHospital');
    Route::get('/EducationalQualification', [App\Http\Controllers\Frontend\HomeController::class, 'EducationalQualification'])->name('EducationalQualification');
    /**
     * Guest route with web guard end
     */
});
/**
 * Fronend route end
 *
 */

/**
 * admin  route start
 */
Route::prefix('admin')->as('admin.')->group(function () {
    /**
     * guest route with admin guard start
     */
    Route::middleware('guest:admin')->group(function () {
        //login controller
        Route::controller(LoginController::class)->group(function () {
            Route::get('/login', 'showLoginForm')->name('login');
            Route::post('/login/post', 'login')->name('login.post');
        });
        //forgetpassword controller
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::get('/reset-password', 'showLinkRequestForm')->name('resetPassword');
            Route::post('/reset-password/post', 'sendResetLinkEmail')->name('resetpassword.post');
        });
        //reset password controller
        Route::controller(ResetPasswordController::class)->group(function () {
            Route::get('/update-password/{token}', 'index')->name('updatePassword');
            Route::post('/update-password', 'update')->name('updatePassword.post');
        });
    });
    /**
     * guest route with admin guard end
     */
    /**
     * Authenticated with admin guard route start
     */
    Route::middleware(['auth:admin', 'checkStatus'])->group(function () {
        //logout
        Route::controller(LoginController::class)->group(function () {
            Route::post('/logout', 'logout')->name('logout');
        });
        //home route
        Route::controller(HomeController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('home');
        });
        //roles route
        Route::controller(RolesController::class)->prefix('roles')->as('roles.')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });
        //admin route
        Route::controller(AdminController::class)->as('admin.')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
        });
        //profile route
        Route::controller(ProfileController::class)->prefix('profile')->as('profile.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update', 'update')->name('update');
            Route::post('/update-password', 'updatePassword')->name('password.update');
        });
        //settings route
        Route::prefix('settings')->as('settings.')->group(function () {
            Route::controller(GeneralSettingsController::class)->group(function () {
                Route::get('/general', 'generalSettings')->name('general');
                Route::post('/general/post/{id}', 'generalSettingsUpdate')->name('general.post');
            });
            Route::controller(ConfigSettingsController::class)->group(function () {
                Route::get('/config', 'configSettings')->name('config');
                Route::get('/config-optimize-clear', 'optimizeClear')->name('config.optimize.clear');
                Route::get('/config-optimize', 'optimize')->name('config.optimize');
            });
        });
        //Doctor Photo
        Route::controller(DoctorPhotoController::class)->prefix('doctor-photo')->as('doctorPhotos.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });
        //Doctor Myself Controller
        Route::controller(DoctorMyselfController::class)->prefix('doctor-myself')->as('doctormyselfs.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });
        //My Educational Qualifications
        Route::controller(EducationalQualificationController::class)->prefix('educationals')->as('educationals.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });
        //Which Hospital
        Route::controller(WhichHospitalController::class)->prefix('which-hospitals')->as('WhichHospitals.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');

        });
        //Awards Record
        Route::controller(AwardsRecordController::class)->prefix('awards-records')->as('AwardsRecords.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });
        //Make An Appointment Controller
        Route::controller(MakeAnAppointmentController::class)->prefix('make-appointments')->as('MakeAppointments.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::post('/massage', 'massage')->name('massage');
            Route::get('/delete/{id}', 'delete')->name('delete');
        });
        //Make An scheduleHospitals Controller
        Route::controller(ScheduleHospitalController::class)->prefix('schedule-hospitals')->as('scheduleHospitals.')->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::get('/show/{id}', 'show')->name('show');
        });
    });
    /**EducationalQualificationController
     * Authenticated with admin guard route end
     */
});
/**
 * admin  route end
 */
Route::fallback(function () {
    return redirect('admin/login');
});
