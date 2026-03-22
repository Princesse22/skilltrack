<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('/signup', function () {
//     return view('auth.signup');
// })->name('signup');

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
