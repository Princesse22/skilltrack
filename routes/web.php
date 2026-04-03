<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;

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

Route::get('/user.dashborad',function(){
    return view('user.dashboard');
})->name('user.dashboard');

Route::get('/admin.dashboard',function(){
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/dashboard', [RoleController::class, 'redirectDashboard'])
    ->middleware('auth')
    ->name('dashboard');
    //prendre une formation
Route::get('/admin/formation/{id}', [AdminController::class, 'voirFormation'])
     ->name('admin.formation.detail')
     ->middleware('auth');

//route pour remplir la formation
Route::get('/formations.editerformation', function()
{
    return view('formations.editerformation');
})->name('formations.editerformation');

//deconnexion
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

// Voir détail formation
Route::get('/admin/formation/{id}', [AdminController::class, 'voirFormation'])
     ->name('admin.formation.detail')
     ->middleware('auth');

// ✅ AJOUTER — Valider une formation
Route::post('/admin/formation/{id}/valider', [AdminController::class, 'valideFormation'])
     ->name('admin.formation.valider')
     ->middleware('auth');

// ✅ AJOUTER — Rejeter une formation
Route::post('/admin/formation/{id}/rejeter', [AdminController::class, 'rejeterFormation'])
     ->name('admin.formation.rejeter')
     ->middleware('auth');

// ✅ AJOUTER — l'import du AdminController en haut du fichier
use App\Http\Controllers\AdminController;
