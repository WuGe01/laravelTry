<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MvimController;
use App\Http\Controllers\TotalController;
use App\Http\Controllers\BottomController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::view('/welcome', 'welcome',['name' => 'KOKOKOKO']);


Route::get('/',[HomeController::class,'index']);
Route::get('/login',[AdminController::class,'showLoginForm']);
Route::get('/news',[NewsController::class,'list']);
Route::redirect('/admin','/admin/title');
Route::prefix('/admin')->group(function(){
    //get
    Route::get('/title',[TitleController::class,'index']);
    Route::get('/ad',[AdController::class,'index']);
    Route::get('/image',[ImageController::class,'index']);
    Route::get('/mvim',[MvimController::class,'index']);
    Route::get('/total',[TotalController::class,'index']);
    Route::get('/bottom',[BottomController::class,'index']);
    Route::get('/news',[NewsController::class,'index']);
    Route::get('/admin',[AdminController::class,'index']);
    Route::get('/menu',[MenuController::class,'index']);
    Route::get('/submenu/{menu_id}',[SubMenuController::class,'index']);
  
    //post
    Route::post('/title',[TitleController::class,'store']);
    Route::post('/ad',[AdController::class,'store']);
    Route::post('/image',[ImageController::class,'store']);
    Route::post('/mvim',[MvimController::class,'store']);
    Route::post('/news',[NewsController::class,'store']);
    Route::post('/admin',[AdminController::class,'store']);
    Route::post('/menu',[MenuController::class,'store']);
    Route::post('/submenu/{menu_id}',[SubMenuController::class,'store']);

    //update
    Route::patch('/title/{id}',[TitleController::class,'update']);
    Route::patch('/ad/{id}',[AdController::class,'update']);
    Route::patch('/total/{id}',[TotalController::class,'update']);
    Route::patch('/bottom/{id}',[BottomController::class,'update']);
    Route::patch('/image/{id}',[ImageController::class,'update']);
    Route::patch('/mvim/{id}',[MvimController::class,'update']);
    Route::patch('/news/{id}',[NewsController::class,'update']);
    Route::patch('/admin/{id}',[AdminController::class,'update']);
    Route::patch('/menu/{id}',[MenuController::class,'update']);
    Route::patch('/submenu/{id}',[SubMenuController::class,'update']);

});


Route::prefix('/modals')->group(function(){

    //modals
    Route::get('/addTitle',[TitleController::class,'create']);
    Route::get('/addAd',[AdController::class,'create']);
    Route::get('/addImage',[ImageController::class,'create']);
    Route::get('/addMvim',[MvimController::class,'create']);
    Route::get('/addTotal',[TotalController::class,'create']);
    Route::get('/addBottom',[BottomController::class,'create']);
    Route::get('/addNews',[NewsController::class,'create']);
    Route::get('/addAdmin',[AdminController::class,'create']);
    Route::get('/addMenu',[MenuController::class,'create']);
    Route::get('/addSubMenu/{menu_id}',[SubMenuController::class,'create']);
  
    //edit
    Route::get('/title/{id}',[TitleController::class,'edit']);
    Route::get('/ad/{id}',[AdController::class,'edit']);
    Route::get('/total/{id}',[TotalController::class,'edit']);
    Route::get('/bottom/{id}',[BottomController::class,'edit']);
    Route::get('/image/{id}',[ImageController::class,'edit']);
    Route::get('/mvim/{id}',[MvimController::class,'edit']);
    Route::get('/news/{id}',[NewsController::class,'edit']);
    Route::get('/admin/{id}',[AdminController::class,'edit']);
    Route::get('/menu/{id}',[MenuController::class,'edit']);
    Route::get('/submenu/{id}',[SubMenuController::class,'edit']);

    //delete
    Route::delete('/title/{id}',[TitleController::class,'destroy']);
    Route::delete('/ad/{id}',[AdController::class,'destroy']);
    Route::delete('/image/{id}',[ImageController::class,'destroy']);
    Route::delete('/mvim/{id}',[MvimController::class,'destroy']);
    Route::delete('/news/{id}',[NewsController::class,'destroy']);
    Route::delete('/admin/{id}',[AdminController::class,'destroy']);
    Route::delete('/menu/{id}',[MenuController::class,'destroy']);
    Route::delete('/submenu/{id}',[SubMenuController::class,'destroy']);

    //show
    Route::patch('/title/sh/{id}',[TitleController::class,'display']);
    Route::patch('/ad/sh/{id}',[AdController::class,'display']);
    Route::patch('/image/sh/{id}',[ImageController::class,'display']);
    Route::patch('/mvim/sh/{id}',[MvimController::class,'display']);
    Route::patch('/news/sh/{id}',[NewsController::class,'display']);
    Route::patch('/admin/sh/{id}',[AdminController::class,'display']);
    Route::patch('/menu/sh/{id}',[MenuController::class,'display']);

});


