<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::group(['middleware'=>'api'], function (){
//    Route::post('get-main-projects', [ProjectController::class]);
// });


Route::middleware(['api','checkPassword','changeLanguage'])->group(function(){
   Route::post('get-main-projects', [ProjectController::class,'index']);
   Route::post('get-project-byId', [ProjectController::class,'getCategoryById']);


   Route::middleware(['api','checkPassword','changeLanguage'])->prefix('admin')->group(function(){

      Route::get('login', [AuthController::class,'login']);

   });
   
});

Route::middleware(['api','checkPassword','changeLanguage','checkAdminToken:admin-api'])->group(function(){
   Route::get('offers', [ProjectController::class,'index']);
});


// Route::middleware('auth:api')->get('/user',function($request){
//    return $request->user();

// });