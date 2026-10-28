<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ResetPasswordController;

Route::get('/reset-password/{token}',[ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password',[ResetPasswordController::class, 'resetPassword'])->name('password.update');


Route::get('/test-email',function(){
Mail::raw('this is a test mail', function($message){
    $message->to('emashahzad11@gmail.com')->subject('welcome');
});
return 'mail sent successfully';
});
