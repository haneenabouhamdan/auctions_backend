<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuctionItemsController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\WinnerController;
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

Route::get('/user', function (Request $request) {
    return $request->user();
});
//user routes
Route::middleware('auth:sanctum')->post('/users/edit', [UserController::class, 'edit_profile']);
Route::middleware('auth:sanctum')->post('/editImage', [UserController::class, 'uploadimage']);
Route::middleware('auth:sanctum')->post('/addFav', [UserController::class, 'add_fav']);
Route::get('/getUser/{owner_id}', [UserController::class,'getUser']);
Route::middleware('auth:sanctum')->get('/getWin/{id}', [UserController::class,'getUseer']);
Route::get('/countwins', [WinnerController::class,'getCountWins']);
Route::middleware('auth:sanctum')->get('/getAllEmails',[UserController::class, 'getAllEmails']);
Route::middleware('auth:sanctum')->post('/getUserByFullname',[UserController::class, 'getUserByFullname']);
Route::middleware('auth:sanctum')->get('/getEmail/{id}', [UserController::class, 'getEmail']);
//Auction routes
Route::get('/getResdentialItems', [AuctionItemsController::class, 'getResidentialItems']);
Route::get('/getCommercialItems', [AuctionItemsController::class, 'getCommercialItems']);
Route::get('/getIndustrialItems', [AuctionItemsController::class, 'getIndustrialItems']);
Route::get('/getOtherslItems', [AuctionItemsController::class, 'getOthersItems']);
Route::middleware('auth:sanctum')->get('/getCount', [AuctionItemsController::class, 'getCount']);
Route::middleware('auth:sanctum')->get('/getFavCount', [AuctionItemsController::class, 'getFavCount']);
Route::middleware('auth:sanctum')->post('/addAuction', [AuctionItemsController::class, 'add_item']);
Route::middleware('auth:sanctum')->get('/getUserAuctions', [AuctionItemsController::class, 'getAllItems']);
Route::get('/getAllAuctions', [AuctionItemsController::class, 'getAllOtherItems']);
Route::middleware('auth:sanctum')->get('/getFav', [AuctionItemsController::class, 'getFavItems']);
Route::middleware('auth:sanctum')->post('/remFav', [AuctionItemsController::class, 'removeFavItems']);
Route::middleware('auth:sanctum')->get('/getItemDetails', [AuctionItemsController::class, 'getItemDetails']);
Route::middleware('auth:sanctum')->post('/remAuc', [AuctionItemsController::class, 'removeItems']);
Route::get('/getItem',[AuctionItemsController::class, 'getItem']);
Route::get('/getDetails/{id}',[AuctionItemsController::class, 'getDetails']);
Route::middleware('auth:sanctum')->post('/closeAuc', [AuctionItemsController::class, 'closeAuc']);
Route::get('/getUAuctions',[AuctionItemsController::class, 'getAuctions']);
// Route::middleware('auth:sanctum')->post('/getItemsById', [AuctionItemsController::class, 'getItemsById']);
Route::middleware('auth:sanctum')->post('/getParAuctions',[AuctionItemsController::class, 'getItemsById']);

//Interests
Route::middleware('auth:sanctum')->post('/addInterest', [InterestsController::class, 'add_interest']);
Route::get('/getInterests',[InterestsController::class, 'get_interests']);
Route::middleware('auth:sanctum')->post('/deleteInterest',[InterestsController::class, 'del_interest']);
Route::post('/recomend',[AuctionItemsController::class, 'getRecomend']);
Route::middleware('auth:sanctum')->post('/SetWinner',[WinnerController::class,'add_winner']);
Route::middleware('auth:sanctum')->get('/getWon',[AuctionItemsController::class,'get_won_items']);
Route::middleware('auth:sanctum')->get('/getTheWinner/{id}',[WinnerController::class,'get_winner']);
//filtering
Route::post('/filter',[AuctionItemsController::class, 'filter']);

//payment routes
Route::post('/addPayment',[PaymentController::class,'addPaymentDetails']);
Route::post('/stripe/webhook',[WebhookController::class, 'handleWebhook']);
Route::post('/purchase', function (Request $request) { $stripeCharge = $request->user()->charge( 100, $request->paymentMethodId);});
