<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\TwilioController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\TwilioAuthLogin;

//----------------------Admin-----------------------------------------------
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\SubProfessionController;
use App\Http\Controllers\Admin\CredentialClassificationController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProfessionCountryController;
use App\Http\Controllers\Admin\ProfessionRuleController;
use App\Http\Controllers\Admin\FieldTypeController;
use App\Http\Controllers\Admin\FormFieldController;
use App\Http\Controllers\Admin\CredentialFormController;
use App\Http\Controllers\Admin\CredentialFormFieldRuleController;


//----------------------Customer-----------------------------------------------
use App\Http\Controllers\Customer\ApplicationController;
use App\Http\Controllers\Customer\ApplicationDetailController;
use App\Http\Controllers\Customer\UserDetailsController;
use App\Http\Controllers\Payment\StripeController;

use App\Http\Controllers\ApplicationProcess\ApplicationProcessController;
use App\Http\Controllers\ApplicationProcess\ApplicationDetailProcessController;
use App\Http\Controllers\JiraController;



//----------------------Agent-----------------------------------------------
use App\Http\Controllers\Agent\AgentCustomerController;
use App\Http\Controllers\Agent\AgentApplicationController;
use App\Http\Controllers\Agent\AgentInvoiceController;
use App\Http\Controllers\Agent\AgentActivityLogController;

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


Route::get('/', [HomeController::class, 'index'])->name('index.home');

Route::post('/register/store', [RegisteredUserController::class, 'register_store']);
Route::post('/newPassword/store', [NewPasswordController::class, 'resetPasswordConfirm'])->name('newPassword.store');

Route::get('/notqualified', function () {
    return view('notqualified');
});

Route::get('/application-process', function () {
    return view('customer.application_process.application-process');
});

//****************************** Authentication Login using Phone Number ****************************
Route::get('/getTimerRemainingLogin', [TwilioAuthLogin::class, 'getTimerRemaining'])->name('getTimerRemainingLogin');
Route::post('/sendOptUserPhoneLogin', [TwilioAuthLogin::class, 'sendOptUserPhone'])->name('sendOptUserPhoneLogin');
Route::post('/send_new_otp_login', [TwilioAuthLogin::class, 'send_new_otp'])->name('send_new_otp_login');
Route::post('/verify_otp_login', [TwilioAuthLogin::class, 'verify_otp_login'])->name('verify_otp_login');

Route::middleware(['prevent-back-history'])->group(function () {

    Route::middleware(['auth'])->group(function () {

        Route::get('/home', HomeController::class)->name('home');

        Route::get('/testdashboard', function () {
            return view('dashboard');
        });
        Route::get('/testpdf', [StripeController::class, 'testpdf']);

        //----------------------------------------------------------------------------------------------------------------
        //--------------------------------Admin Routes Section------------------------------------------------------------
        //----------------------------------------------------------------------------------------------------------------
        Route::middleware(['admin'])->prefix('admin')->group(function () {

            Route::get('admin-dashboard', function () {
                return view('/admin/admin-dashboard');
            })->name('admin-dashboard');

            Route::get('basic-setting', [SettingController::class, 'basicSetting'])->name('basic-setting');
            Route::post('update-basic-setting', [SettingController::class, 'updateBasicSetting'])->name('update-basic-setting');

            Route::resource('configuration-settings', ConfigurationController::class);

            Route::resource('professions', ProfessionController::class);
            Route::get('professionActivation/{id}/{status}', [ProfessionController::class, 'professionActivation'])->name('professionActivation');
            Route::get('professionRestore/{id}', [ProfessionController::class, 'professionRestore'])->name('professionRestore');
            
            Route::resource('subprofessions', SubProfessionController::class);

            Route::resource('credentials', CredentialClassificationController::class);
            Route::get('credentialActivation/{id}/{status}', [CredentialClassificationController::class, 'credentialActivation'])->name('credentialActivation');
            Route::get('credentialRestore/{id}', [CredentialClassificationController::class, 'credentialRestore'])->name('credentialRestore');
            
            Route::resource('fields-rules', CredentialFormFieldRuleController::class);

            Route::resource('countries', CountryController::class);
            Route::get('countryActivation/{id}/{status}', [CountryController::class, 'countryActivation'])->name('countryActivation');

            Route::resource('professionCountries', ProfessionCountryController::class);
            Route::resource('professionRules', ProfessionRuleController::class);
            Route::resource('fieldTypes', FieldTypeController::class);
            Route::resource('formFields', FormFieldController::class);
            Route::resource('credentialFormFields', CredentialFormController::class);
        });

        //----------------------------------------------------------------------------------------------------------------
        //--------------------------------Customer Routes Section---------------------------------------------------------
        //----------------------------------------------------------------------------------------------------------------
        Route::middleware(['verified', 'customer'])->prefix('customer')->group(function () {

            Route::get('/verify-phone', [TwilioController::class, 'verify_phone'])->name('verify-phone');
            Route::get('/verify-phone-check', [TwilioController::class, 'verify_phone_check'])->name('verify-phone-check');
            Route::post('/send_otp', [TwilioController::class, 'send_otp'])->name('send_otp');
            Route::post('/send_new_otp', [TwilioController::class, 'send_new_otp'])->name('send_new_otp');
            Route::post('/verify_otp', [TwilioController::class, 'verify_otp'])->name('verify_otp');
            Route::post('/storeNewPhone', [TwilioController::class, 'storeNewPhone'])->name('storeNewPhone');
            Route::get('/getTimerRemaining', [TwilioController::class, 'getTimerRemaining'])->name('getTimerRemaining');

            //****************************** Customer Email Verified Access ****************************
            Route::middleware(['phone-verified'])->group(function () {
                Route::get('/user-details', [UserDetailsController::class, 'show'])->name('user-details');
                Route::post('/storedUserData', [UserDetailsController::class, 'store'])->name('storedUserData');
                

                //****************************** Customer Verified Access ****************************
                Route::middleware(['user-details'])->group(function () {
                    Route::get('/dashboard', [ApplicationProcessController::class, 'index'])->name('dashboard');
                    Route::get('/dashboardApplicationDetail/{id}', [ApplicationProcessController::class, 'dashboardApplicationDetail'])->name('dashboardApplicationDetail');
                    
                    Route::get('/applicationListDataTable/{type}/{status}/{dateRang}/{processID}', [ApplicationProcessController::class, 'applicationListDataTable'])->name('applicationListDataTableCustomer');
                    
                    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
                    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
                    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

                    //****************************** User Account (Show/Edit) ****************************
                    Route::get('/user-account', [ProfileController::class, 'showAccount'])->name('account.show');
                    Route::get('/edit-account', [ProfileController::class, 'editAccount'])->name('account.edit');
                    Route::post('/update-user-account', [ProfileController::class, 'updateUserAccount'])->name('update-user-date');
                    Route::post('/updateUserPassword', [ProfileController::class, 'updateUserPassword'])->name('updateUserPassword');
                    Route::post('/changeUserEmail', [ProfileController::class, 'changeUserEmail'])->name('changeUserEmail');
                    Route::post('/sendOptUserPhone', [TwilioController::class, 'sendOptUserPhone'])->name('sendOptUserPhone');
                    Route::get('/getTimerRemainingEmail', [ProfileController::class, 'getTimerRemainingEmail'])->name('getTimerRemainingEmail');
                    Route::post('/verify_Email_code', [ProfileController::class, 'verifyEmailCode'])->name('verify_Email_code');
                    Route::post('/send_new_email_code', [ProfileController::class, 'sendNewEmailCode'])->name('send_new_email_code');

                    //****************************** User Application (Show/Create/Edit/Delete) ****************************
                    Route::get('applicationType', [ApplicationController::class, 'applicationType'])->name('applicationType');
                    Route::resource('applications', ApplicationController::class);
                    Route::get('show_all', [ApplicationController::class, 'show_all'])->name('show_all');
                    Route::get('/application/search', [ApplicationController::class, 'search'])->name('applications.search');

                    Route::get('/invoices', [ApplicationController::class, 'invoices'])->name('invoices');
                    Route::get('/invoiceDataTable/{type}/{dateRang}', [ApplicationController::class, 'invoiceDataTable'])->name('invoiceDataTable');

                    Route::get('/verification_history', [ApplicationController::class, 'verification_history'])->name('verification_history');
                    Route::get('/verifyHistoryDataTable/', [ApplicationController::class, 'verifyHistoryDataTable'])->name('verifyHistoryDataTable');
                    

                    Route::get('applicationCredential/{id}', [ApplicationController::class, 'applicationCredential'])->name('applicationCredential');
                    Route::resource('applicationDetails', ApplicationDetailController::class);
                    Route::get('app-basic/{id}', [ApplicationDetailController::class, 'appBasic'])->name('app-basic');
                    Route::get('checkout/{id}', [ApplicationController::class, 'checkout'])->name('checkout');
                    Route::resource('stripe', StripeController::class);
                    Route::resource('application-processes', ApplicationProcessController::class);
                    Route::resource('application-detail-processes', ApplicationDetailProcessController::class);
                    Route::get('delete-credential', [ApplicationDetailProcessController::class, 'deleteCredential'])->name('delete-credential');
                    Route::get('setNextStep/{id}/{step}', [ApplicationProcessController::class, 'setNextStep'])->name('setNextStep');
                    Route::get('refreshData/{id}', [ApplicationProcessController::class, 'refreshData'])->name('refreshData');
                    Route::post('saveDocument', [ApplicationDetailProcessController::class, 'saveDocument'])->name('saveDocument');
                    Route::get('reviewData/{id}', [ApplicationProcessController::class, 'reviewData'])->name('reviewData');
                    Route::get('invoiceData/{id}', [ApplicationProcessController::class, 'invoiceData'])->name('invoiceData');
                    Route::post('/loaGenerate', [ApplicationProcessController::class, 'loaGenerate'])->name('loaGenerate');
                    Route::post('/loa/clearfiles', [ApplicationProcessController::class, 'loaCleaFiles'])->name('loaCleaFiles');
                    Route::get('/update_tour', [UserDetailsController::class, 'updateTour'])->name('update_tour');

                      //****************************** JIRA API Requests (Create/Get) ****************************
                      Route::get('DateAPI', [JiraAPIController::class, 'create']);
                      Route::get('getDataAPI', [JiraAPIController::class, 'getRequest']);

                });
            });
        });

        //----------------------------------------------------------------------------------------------------------------
        //--------------------------------Agent Routes Section------------------------------------------------------------
        //----------------------------------------------------------------------------------------------------------------
        Route::middleware(['agent'])->prefix('agent')->group(function () {

            Route::get('agent-dashboard', function () {
                return view('/agent/agent-dashboard');
            })->name('agent-dashboard');

            Route::resource('/user-list', AgentCustomerController::class);
            Route::get('/userListDataTable', [AgentCustomerController::class, 'userListDataTable'])->name('userListDataTable');

            Route::resource('/application-list', AgentApplicationController::class);
            Route::get('/applicationListDataTable', [AgentApplicationController::class, 'applicationListDataTable'])->name('applicationListDataTable');

            Route::resource('/invoice-list', AgentInvoiceController::class);
            Route::get('/invoiceListDataTable', [AgentInvoiceController::class, 'invoiceListDataTable'])->name('invoiceListDataTable');

            Route::resource('/activitylog-list', AgentActivityLogController::class);
            Route::get('/activitylogListDataTable', [AgentActivityLogController::class, 'activitylogListDataTable'])->name('activitylogListDataTable');

        });
        //----------------------------------------------------------------------------------------------------------------


    });
});


require __DIR__ . '/auth.php';