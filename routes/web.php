<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Routes pour les pages (à implémenter plus tard)
Route::get('/formations.index', function () {
    return view('formations.index');
})->name('formations.index');
// modalites de formation
Route::get('/formations.paiement', function()
{
    return view('formations.paiement');
})->name('formations.paiement');

//suivre formations
Route::get('/formations.suivref', function()
{
    return view('formations.suivref');
})->name('formations.suivref');

Route::get('/mentors', function () {
    return view('mentors');
})->name('mentors');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('register-login', [UsersController::class, 'showRegisterLogin'])->name('register-login');
 Route::post('/register',[UsersController::class, 'register'])->name('register');
 Route::post('login', [UsersController::class, 'login'])->name('login');

 // code de verification via mail

Route::get('/auth/emailVerify', [UsersController::class, 'emailVerify'])->name('auth.emailVerify');
 // Vérification du code saisi par l'utilisateur
Route::post('/auth/verifyCode', [UsersController::class, 'verifyCode'])->name('auth.verifyCode');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/partner', function () {
    return view('partner');
})->name('partner');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Newsletter subscription
Route::post('/newsletter/subscribe', function () {
    // Logic to handle newsletter subscription
    return redirect()->back()->with('success', 'Successfully subscribed to newsletter!');
})->name('newsletter.subscribe');

//devenir partenaire
Route::get('/partenaire.index',function(){
    return view('partenaire.index');
})->name('partenaire.index');
// dashbord partenaire
Route::get('/partenaire.dashboard',function(){
    return view('partenaire.dashboard');
})->name('partenaire.dashboard');


//deconnexion
Route::get('/logout', function () {
    return view('logout');
})->name('logout');
