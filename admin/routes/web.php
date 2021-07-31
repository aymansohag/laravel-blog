<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\http\controllers\HomeController;
use App\http\controllers\VisitorController;
use App\http\controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\GalleryController;
use App\Models\Testimonial;

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

/**
 * Home Page Route
 */

Route::get('/', [HomeController::class, 'homeIndex']) -> name('home.index') -> middleware('loginCheck');

/**
 * Visitor page route
 */
Route::get('visitor', [VisitorController::class, 'visitorIndex']) -> name('visitor.index') -> middleware('loginCheck');


/**
 * Admin Panel Services Management
 */

Route::get('service', [ServiceController::class, 'serviceIndex']) -> name('service.index') -> middleware('loginCheck');
Route::get('getServiceData', [ServiceController::class, 'getServiceData']) -> name('getServiceData') -> middleware('loginCheck');
Route::post('ServiceDelete', [ServiceController::class, 'ServiceDelete']) -> name('service.delete') -> middleware('loginCheck');
Route::post('ServiceDetails', [ServiceController::class, 'getServiceDetails']) -> name('service.details') -> middleware('loginCheck');
Route::post('serviceUpdate', [ServiceController::class, 'serviceUpdate']) -> name('service.update') -> middleware('loginCheck');
Route::post('serviceAdd', [ServiceController::class, 'serviceAdd']) -> name('service.add') -> middleware('loginCheck');


/**
 * Admin Panel Courses Management
 */

Route::get('courses', [CourseController::class, 'coursesIndex']) -> name('courses.index') -> middleware('loginCheck');
Route::get('getCoursesData', [CourseController::class, 'getCoursesData']) -> name('getCoursesData') -> middleware('loginCheck');
Route::post('coursesDetails', [CourseController::class, 'getCoursesDetails']) -> name('courses.details') -> middleware('loginCheck');
Route::post('coursesDelete', [CourseController::class, 'courseseDelete']) -> name('courses.delete') -> middleware('loginCheck');
Route::post('coursesUpdate', [CourseController::class, 'coursesUpdate']) -> name('courses.update') -> middleware('loginCheck');
Route::post('coursesAdd', [CourseController::class, 'coursesAdd']) -> name('courses.add') -> middleware('loginCheck');



/**
 * Admin Panel Project Management
 */

Route::get('projects', [ProjectController::class, 'projecstIndex']) -> name('projects.index') -> middleware('loginCheck');
Route::get('getProjectsData', [ProjectController::class, 'getProjectsData']) -> name('getProjectsData') -> middleware('loginCheck');
Route::post('projectDelete', [ProjectController::class, 'projectDelete']) -> name('project.delete') -> middleware('loginCheck');
Route::post('projectEdit', [ProjectController::class, 'projectEdit']) -> name('project.edit') -> middleware('loginCheck');
Route::post('projectAdd', [ProjectController::class, 'projectAdd']) -> name('project.add') -> middleware('loginCheck');
Route::post('projectUpdate', [ProjectController::class, 'projectUpdate']) -> name('project.update') -> middleware('loginCheck');


/**
 * Admin Panel Contact Management
 */

Route::get('contact', [ContactController::class, 'ContactIndex']) -> name('contact.index') -> middleware('loginCheck');
Route::get('getContactData', [ContactController::class, 'getContactData']) -> name('getContactData') -> middleware('loginCheck');
Route::post('contactDelete', [ContactController::class, 'contactDelete']) -> name('contact.delete') -> middleware('loginCheck');


/**
 * Admin Panel Testimonial Management
 */

Route::get('testimonial', [TestimonialController::class, 'testimonialIndex']) -> name('testimonial.index') -> middleware('loginCheck');
Route::get('getTestimonialData', [TestimonialController::class, 'getTestimonialData']) -> name('getTestimonialData') -> middleware('loginCheck');
Route::post('testimonialAdd', [TestimonialController::class, 'testimonialAdd']) -> name('testimonial.create') -> middleware('loginCheck');
Route::post('testimonialDelete', [TestimonialController::class, 'testimonialDelete']) -> name('testimonial.delete') -> middleware('loginCheck');
Route::post('testimonialEdit', [TestimonialController::class, 'testimonialEdit']) -> name('testimonial.edit')-> middleware('loginCheck');
Route::post('testimonialUpdate', [TestimonialController::class, 'testimonialUpdate']) -> name('testimonial.update') -> middleware('loginCheck');

/**
 * Admin Panel Login Management
 */

 Route::get('Login', [LoginController::class, 'index']) -> name('login.index');
 Route::post('onLogin', [LoginController::class, 'onLogin']) -> name('onLogin');
 Route::get('Logout', [LoginController::class, 'onLogout']) -> name('logout');


//  Admin Photo Gallery

Route::get('Gallery', [GalleryController::class, 'galleryIndex']) -> name('gallery.index')  -> middleware('loginCheck');
Route::post('galleryStore', [GalleryController::class, 'galleryStore']) -> name('gallery.store')  -> middleware('loginCheck');
Route::get('galeryShow', [GalleryController::class, 'galeryShow']) -> name('gallery.show')  -> middleware('loginCheck');
Route::get('galeryShowByLoad/{id}', [GalleryController::class, 'galeryShowByLoad']) -> name('gallery.load')  -> middleware('loginCheck');
Route::post('galeryDelete', [GalleryController::class, 'galeryDelete']) -> name('gallery.delete')  -> middleware('loginCheck');

