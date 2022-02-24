<?php

use Illuminate\Support\Facades\Artisan;
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

/******************ADMIN PANELS ROUTES****************/
Route::group(['prefix' => 'admin', 'as'=>'admin.','namespace' => 'Admin'], function () {
 
    /*******************LOGIN ROUTES*************/
    Route::view('login', 'admin.auth.index')->name('login');
    Route::post('login','AuthController@login');
    Route::group(['middleware' => 'auth:admin'], function () { 
    /*******************Logout ROUTES*************/       
    Route::get('logout','AuthController@logout')->name('logout');
    /*******************Dashoard ROUTES*************/
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard.index');
    /******************ADMIN ROUTES****************/
      Route::resource('admin', 'AdminController');    
    /*******************Profile ROUTES*************/
    Route::view('profile', 'admin.profile.index')->name('profile.index');
    /******************User ROUTES****************/
    Route::get('user', 'UserController@index')->name('user.index');  
    Route::get('user/actives', 'UserController@active')->name('user.actives');  
    Route::get('user/blocks', 'UserController@blocks')->name('user.blocks');  
    Route::get('user/create', 'UserController@create')->name('user.create');  
    Route::get('police_station_users', 'UserController@PoliceStationUser')->name('user.police_station');  
    Route::get('prosecution_branch_users', 'UserController@ProsecutionBranchUsers')->name('user.prosecution_branch');  
    Route::get('court_users', 'UserController@CourtUsers')->name('user.court');  
    Route::get('user/detail/{id}','UserController@showDetail')->name('user.detail');
    Route::get('user/activation/{id}','UserController@activation')->name('user.activation');
    Route::get('user/delete/{id}','UserController@delete')->name('user.delete');
    Route::get('user/block/{id}','UserController@block')->name('user.block');
    Route::post('user/update','UserController@update')->name('user.update');
    Route::post('user/store','UserController@store')->name('user.store');
    Route::get('user/{user}/fake/login', 'UserController@fakeLogin')->name('login.fake');
    /******************CHALLAN ROUTES****************/
    Route::get('file_send_after_3_days/pending/{id}','ChallanController@file_send_after_3_days_pending')->name('file_send_after_3_days.pending');
    Route::get('file_send_after_3_days/active/{id}','ChallanController@file_send_after_3_days_active')->name('file_send_after_3_days.active');
    Route::get('challan_receive_in_branch/pending/{id}','ChallanController@challan_receive_in_branch_pending')->name('challan_receive_in_branch.pending');
    Route::get('challan_receive_in_branch/active/{id}','ChallanController@challan_receive_in_branch_active')->name('challan_receive_in_branch.active');
    Route::get('challan/pending','ChallanController@pendingChallan')->name('challan.pending_challan');
    Route::get('challan/pending_by_court','ChallanController@pendingChallanByCourt')->name('challan.pending_by_court');
    Route::get('challan/pending_by_prosecution','ChallanController@pendingChallanByProsecution')->name('challan.pending_by_prosecution');
    Route::get('challan/pending_by_ps','ChallanController@pendingChallanByPs')->name('challan.pending_by_ps');
    Route::get('challan/pending_by_ps_in_contacts','ChallanController@pendingbypsincontacts')->name('challan.pending_by_ps_in_contacts');
    Route::get('challan/pending_by_ps_in_interim_report','ChallanController@pendingByPsInInterimReport')->name('challan.pending_by_ps_in_interim_report');
    Route::get('challan/objection','ChallanController@ChallanObjection')->name('challan.objection');
    Route::get('challan/court','ChallanController@Challancourt')->name('challan.court');
    Route::get('challan/passed','ChallanController@ChallanPassed')->name('challan.passed');
    Route::resource('challan', 'ChallanController');  
   });
});
/******************USER PANELS ROUTES****************/
Route::group(['as'=>'user.','prefix' => 'user','namespace' => 'User'], function () {
 
    /*******************LOGIN ROUTES*************/
    Route::view('login', 'user.auth.login')->name('login');
    Route::post('login','AuthController@login');
    Route::group(['middleware' => 'auth:user'], function () { 
        /*******************Logout ROUTES*************/       
        Route::get('logout','AuthController@logout')->name('logout');
        /*******************Dashoard ROUTES*************/
        Route::get('dashboard', 'UserController@dashboard')->name('dashboard.index');
       /******************USER PROFILE  ROUTES****************/
       Route::resource('user', 'UserController'); 
        /******************FIR ROUTES****************/ 
       Route::resource('fir', 'FIRController');  

       /******************CHALLAN ROUTES****************/
       Route::get('i_o_contacted_to_complainant/pending/{id}','ChallanController@i_o_contacted_to_complainant_pending')->name('i_o_contacted_to_complainant.pending');
       Route::get('i_o_contacted_to_complainant/active/{id}','ChallanController@i_o_contacted_to_complainant_active')->name('i_o_contacted_to_complainant.active');
       Route::get('challan_prepare_within_14_days/pending/{id}','ChallanController@challan_prepare_within_14_days_pending')->name('challan_prepare_within_14_days.pending');
       Route::get('challan_prepare_within_14_days/active/{id}','ChallanController@challan_prepare_within_14_days_active')->name('challan_prepare_within_14_days.active');
       Route::get('challan_interim_report_within_14_days/pending/{id}','ChallanController@challan_interim_report_within_14_days_pending')->name('challan_interim_report_within_14_days.pending');
       Route::get('challan_interim_report_within_14_days/active/{id}','ChallanController@challan_interim_report_within_14_days_active')->name('challan_interim_report_within_14_days.active');
       Route::get('challan_resubmitted_after_defect_removals/pending/{id}','ChallanController@challan_resubmitted_after_defect_removals_pending')->name('challan_resubmitted_after_defect_removals.pending');
        Route::get('challan_resubmitted_after_defect_removals/active/{id}','ChallanController@challan_resubmitted_after_defect_removals_active')->name('challan_resubmitted_after_defect_removals.active');
       Route::get('challan/pending','ChallanController@pendingChallan')->name('challan.pending_challan');
       Route::get('challan/in_process','ChallanController@inProcessChallan')->name('challan.in_process_challan');
       Route::get('challan/passed','ChallanController@passedChallan')->name('challan.passed_challan');
       Route::get('challan/objection','ChallanController@objectionChallan')->name('challan.objection_challan');
       Route::get('challan/court','ChallanController@court')->name('challan.court');
       Route::post('challan/challan_sent_to_prosecution_date/{id}','ChallanController@challan_sent_to_prosecution_date_store')->name('challan.challan_sent_to_prosecution_date');
       Route::post('challan/challan_passed_date/{id}','ChallanController@challan_passed_date_store')->name('challan.challan_passed_date');
       Route::post('challan/date_of_receiving_challan_in_court/{id}','ChallanController@date_of_receiving_challan_in_court')->name('challan.date_of_receiving_challan_in_court');
       Route::resource('challan', 'ChallanController');  
    });


    
});

// Route::post('user/deposit', 'User\DepositController@store')->name('user.deposit.store');
/******************FRONTEND ROUTES****************/
Route::get('/', 'User\AuthController@index');

/******************FUNCTIONALITY ROUTES****************/
Route::get('/cd', function() {
    Artisan::call('config:cache');
    // Artisan::call('migrate:refresh');
    // Artisan::call('db:seed', [ '--class' => DatabaseSeeder::class]);
    Artisan::call('view:clear');
    return 'DONE';
});
Route::get('/migrate', function() {
    Artisan::call('migrate');
    return 'Migration done';
});
Route::get('/cache_clear', function() {
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return 'Cache Clear DOne';
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

