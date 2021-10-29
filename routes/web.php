<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Login;

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

Route::get('/',Login::class)->middleware('guest');
Route::get('/register',Register::class)->middleware('guest');
Route::get('/login',Login::class)->middleware('guest');
Route::get('/logout',function (){
    Auth::logout();
    return redirect()->to('/login');
});

Route::group(['prefix'=>'admin','middleware'=>'checkAdminLogin'],function () {
    Route::get('/',App\Http\Livewire\Admin\Index::class);
    Route::get('/editProfile',App\Http\Livewire\Admin\Pages\EditProfile::class);
    Route::get('/UsersManagement/userGroupsList',App\Http\Livewire\Admin\Pages\UserGroupsList::class);
    Route::get('/UsersManagement/usersList',App\Http\Livewire\Admin\Pages\Users::class);
    Route::get('/Contents/textsList',App\Http\Livewire\Admin\Pages\Texts::class);
    Route::get('/Contents/slidersList',App\Http\Livewire\Admin\Pages\Sliders::class);
    Route::get('/Settings/Prepaid',App\Http\Livewire\Admin\Pages\Prepaid::class);
    Route::get('/Settings/BookingStatuses',App\Http\Livewire\Admin\Pages\BookingStatuses::class);
    Route::get('/Settings/BarbersList',App\Http\Livewire\Admin\Pages\Barbers::class);
    Route::get('/ContactUs',App\Http\Livewire\Admin\Pages\Contact::class);
    Route::get('/ContactUs/{id}',App\Http\Livewire\Admin\Pages\Contact::class);
    Route::get('/Reservations',App\Http\Livewire\Admin\Pages\Reservations::class);
    Route::get('/Reservations/{id}',App\Http\Livewire\Admin\Pages\Reservations::class);
    Route::get('/FinanceInfo',App\Http\Livewire\Admin\Pages\Finance::class);
});
Route::group(['prefix'=>'UserPanel','middleware'=>'checkCustomerLogin'],function () {
    Route::get('/',App\Http\Livewire\Customers\Index::class);
});

Breadcrumbs::for('admin', function ($trail) {
    $trail->push('HOME', url('admin'));
});
Breadcrumbs::for('adminEditProfile', function ($trail) {
    $trail->push('EditProfile', url('admin/editProfile'));
});
//userGroups
Breadcrumbs::for('userGroupsList', function ($trail) {
    $trail->push('UserGroupsList / Users Management', url('admin/userGroupsList'));
});
Breadcrumbs::for('AddNewGroup', function ($trail) {
    $trail->push('AddNewGroup / Users Management', url('admin/userGroupsList'));
});
Breadcrumbs::for('EditGroup', function ($trail) {
    $trail->push('EditGroup / Users Management', url('admin/userGroupsList'));
});
//users
Breadcrumbs::for('usersList', function ($trail) {
    $trail->push('UsersList / Users Management', url('admin/usersList'));
});
Breadcrumbs::for('AddNewUser', function ($trail) {
    $trail->push('AddNewUser / Users Management', url('admin/usersList'));
});
Breadcrumbs::for('EditUser', function ($trail) {
    $trail->push('EditUser / Users Management', url('admin/usersList'));
});
//texts
Breadcrumbs::for('textList', function ($trail) {
    $trail->push('TextsList / Contents', url('admin/textsList'));
});
Breadcrumbs::for('AddNewText', function ($trail) {
    $trail->push('AddNewUser / Contents', url('admin/textsList'));
});
Breadcrumbs::for('EditText', function ($trail) {
    $trail->push('EditText / Contents', url('admin/textsList'));
});
//sliders
Breadcrumbs::for('SlidersList', function ($trail) {
    $trail->push('SlidersList / Contents', url('admin/slidersList'));
});
Breadcrumbs::for('AddNewSlider', function ($trail) {
    $trail->push('AddNewSlider / Contents', url('admin/slidersList'));
});
Breadcrumbs::for('EditSlider', function ($trail) {
    $trail->push('EditSlider / Contents', url('admin/slidersList'));
});
//prepaid
Breadcrumbs::for('Prepaid', function ($trail) {
    $trail->push('Prepaid / Settings', url('admin/Prepaid'));
});
Breadcrumbs::for('EditPrepaid', function ($trail) {
    $trail->push('EditPrepaid / Settings', url('admin/Prepaid'));
});
//status
Breadcrumbs::for('Booking Statuses', function ($trail) {
    $trail->push('Booking Statuses / Settings', url('admin/Booking Statuses'));
});
Breadcrumbs::for('AddNewStatuses', function ($trail) {
    $trail->push('AddNewStatuses / Settings', url('admin/Booking Statuses'));
});
Breadcrumbs::for('Edit Booking Statuses', function ($trail) {
    $trail->push('Edit Booking Statuses / Settings', url('admin/Booking Statuses'));
});
//barbers
Breadcrumbs::for('BarbersList', function ($trail) {
    $trail->push('BarbersList / Settings', url('admin/BarbersList'));
});
Breadcrumbs::for('AddNewBarber', function ($trail) {
    $trail->push('AddNewBarber / Settings', url('admin/BarbersList'));
});
Breadcrumbs::for('EditBarber', function ($trail) {
    $trail->push('EditBarber / Settings', url('admin/BarbersList'));
});
//ContactUs
Breadcrumbs::for('ContactUs', function ($trail) {
    $trail->push('ContactUs', url('admin/ContactUs'));
});
Breadcrumbs::for('Details', function ($trail) {
    $trail->push('Details / ContactUs', url('admin/ContactUs'));
});
//reserves
Breadcrumbs::for('ReservationsList', function ($trail) {
    $trail->push('List / Reservations', url('admin/ReservationsList'));
});
Breadcrumbs::for('ReserveDetails', function ($trail) {
    $trail->push('Details / Reservations', url('admin/ReservationsList'));
});
//transactionsList
Breadcrumbs::for('transactionsList', function ($trail) {
    $trail->push('TransactionsList / FinanceInfo', url('admin/FinanceInfo'));
});

//customers
Breadcrumbs::for('userPanel', function ($trail) {
    $trail->push('Dashboard / Home', url('UserPanel'));
});
