<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuctionItemsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//user routes
Route::middleware('auth:sanctum')->post('/users/edit', [UserController::class, 'edit_profile']);
Route::middleware('auth:sanctum')->post('/editImage', [UserController::class, 'uploadimage']);

//Auction routes
Route::get('/getResdentialItems', [AuctionItemsController::class, 'getResidentialItems']);
Route::get('/getIndustrialItems', [AuctionItemsController::class, 'getCommercialItems']);
Route::get('/getCommercialItems', [AuctionItemsController::class, 'getIndustrialItems']);
Route::get('/getOtherslItems', [AuctionItemsController::class, 'getOthersItems']);
Route::middleware('auth:sanctum')->post('/addAuction', [AuctionItemsController::class, 'add_item']);
Route::middleware('auth:sanctum')->get('/getUserAuctions', [AuctionItemsController::class, 'getAllItems']);


//payment routes
Route::post('/addPayment',[PaymentController::class,'addPaymentDetails']);
Route::post('/stripe/webhook',[WebhookController::class, 'handleWebhook']);
Route::post('/purchase', function (Request $request) { $stripeCharge = $request->user()->charge( 100, $request->paymentMethodId);});
