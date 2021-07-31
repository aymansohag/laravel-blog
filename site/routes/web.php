<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProjectsCntroller;
use App\Http\Controllers\TermsController;

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

Route::get('/', [HomeController::class, 'homeIndex']) -> name('home.index');
Route::post('contactSend', [HomeController::class, 'contactSend']) -> name('home.contact');

// Course page
Route::get('/course', [CoursesController::class, 'index']) -> name('course.index');
// Policy Page
Route::get('/policy', [PolicyController::class, 'index']) -> name('policy.index');
// Project Page
Route::get('/project', [ProjectsCntroller::class, 'index']) -> name('project.index');
// Terms Page
Route::get('/terms', [TermsController::class, 'index']) -> name('terms.index');
// Contact Page
Route::get('/contact', [ContactController::class, 'index']) -> name('contact.index');
