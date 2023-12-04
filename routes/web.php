<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/', function () {
    return view('main_menu');
});

Route::get('/send-form-create', function(){
    return view('form_create_account');
});

Route::post('/submit-form-create', [Controller::class, 'createAccount']);

Route::get('/send-form-add', function(){
    return view('form_add_credit');
});

Route::post('/submit-form-add', [Controller::class, 'addCredit']);

Route::get('/show-list', [Controller::class, 'showAccountsList']
/*function(){
    return view('accounts_list');
}*/);