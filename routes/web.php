<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FencingController;
use App\Http\Controllers\HistoryLoginController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PinMapController;
use App\Http\Controllers\RidersController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\TransactionController;
use App\Http\Livewire\MapLocation;
use App\Mail\FirstMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin']);
Route::get('/signout', [LoginController::class, 'signout']);
Route::get('/register', [LoginController::class, 'register']);
Route::post('/postregister', [LoginController::class, 'postregister']);

Route::group(['middleware' => ['auth', 'ceckRoles:admin']], function () {
      
Route::get('/', [DashboardController::class, 'dashboard']);
Route::get('taxi', [TaxiController::class, 'taxi']);
//Taxi status
      Route::get('available', [TaxiController::class, 'available']);
      Route::get('booked', [TaxiController::class, 'booked']);
      Route::get('on_ride', [TaxiController::class, 'on_ride']);
      Route::get('under_maintence', [TaxiController::class, 'under_maintence']);
Route::get('riders', [RidersController::class, 'index']);
Route::get('/map/fencing',[FencingController::class, 'fencing']);
Route::get('/country', [CountryController::class, 'country']);
Route::get('/city', [CityController::class, 'city']);
Route::get('/state', [StateController::class, 'state']);
Route::get('/pin', [PinMapController::class, 'pin']);
Route::get('/transaction', [TransactionController::class, 'transaction']);
      Route::post('/insert_trans', [TransactionController::class, 'insert_trans']);

// History Login
      Route::get('/history_login', [HistoryLoginController::class, 'history_login']);
      Route::get('deleteHistory/{id}', [HistoryLoginController::class, 'deleteHistory']);
      
// Broadcast email
      Route::get('/mail', [MailController::class, 'mail']);
      Route::post('/send_mail', [MailController::class, 'send_mail']);


      
// Comparizon
      Route::get('/comparizon', [CompareController::class, 'comparizon']);
      Route::post('compare', [CompareController::class, 'compare']);
     
});
Route::get('user-menu', function () {
      return view('Layouts.users.income');
});


 