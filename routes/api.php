<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/addPayment',[PaymentController::class,'addPaymentDetails']);

Route::post('/stripe/webhook',[WebhookController::class, 'handleWebhook']);
Route::post('/purchase', function (Request $request) { $stripeCharge = $request->user()->charge( 100, $request->paymentMethodId);});
