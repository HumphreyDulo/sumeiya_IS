<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;
use App\Http\Controllers\Client;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Lister;

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
/* ------ Main Pages ------*/
Route::get('/', [Main::class, 'index']);



/* ------ Client Pages ------*/
Route::get('/home', [Client::class, 'home']);
Route::get('/properties', [Client::class, 'properties']);
Route::get('/properties-detail', [Client::class, 'properties_detail']);
Route::get('/gallery', [Client::class, 'gallery']);
Route::get('/blog-archive', [Client::class, 'blog_archive']);
Route::get('/blog-single', [Client::class, 'blog_single']);
Route::post('/booking', [Client::class, 'booking'])->name('booking');



/* ------ Auth Pages ------*/
Route::get('/login', [Auth::class, 'login']);
Route::get('/register', [Auth::class, 'register']);
Route::get('/logout', [Auth::class, 'logout']);
Route::post('/registration', [Auth::class, 'registration'])->name('registration');
Route::post('/logging-in', [Auth::class, 'logging_in'])->name('logging-in');
Route::get('/verify-email/{verification_code}', [Auth::class, 'verify_email'])->name('verify_email');


/* ------ Lister Pages ------*/
Route::get('/lister-dashboard', [Lister::class, 'dashboard']);
Route::get('/new-vacancy', [Lister::class, 'vacancy']);
Route::post('/add-vacancy', [Lister::class, 'new_vacancy'])->name('add-vacancy');
Route::get('/view-vacancies', [Lister::class, 'view_vacancies']);
Route::get('/vacancy-history', [Lister::class, 'vacancy_history']);
Route::get('/bookings', [Lister::class, 'bookings']);
Route::get('/approve{id}', [Lister::class, 'approve'])->name('approve');
Route::get('/reject{id}', [Lister::class, 'reject'])->name('reject');
Route::get('/engaged{id}', [Lister::class, 'engaged'])->name('engaged');
Route::get('/delete{id}', [Lister::class, 'delete'])->name('delete');
Route::get('/edit{id}', [Lister::class, 'edit'])->name('edit');
Route::post('/update{id}', [Lister::class, 'update'])->name('update');

/* ------ Admin Pages ------*/
Route::get('/admin-dashboard', [Admin::class, 'dashboard']);
