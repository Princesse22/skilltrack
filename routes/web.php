<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PartenaireController;

Route::get('/', fn() => view('welcome'))->name('welcome');

Route::get('/formations.index', fn() => view('formations.index'))->name('formations.index');
Route::get('/formations.paiement', fn() => view('formations.paiement'))->name('formations.paiement');
Route::get('/formations.suivref', fn() => view('formations.suivref'))->name('formations.suivref');
//route des champs du header
Route::get('/mentors', fn() => view('mentors'))->name('mentors');
Route::get('/blog', fn() => view('blog'))->name('blog');
Route::get('/profile', fn() => view('profile'))->name('profile');
Route::get('/contact', fn() => view('contact'))->name('contact');

// Inscription / Connexion
Route::get('register-login', [UsersController::class, 'showRegisterLogin'])->name('register-login');
Route::post('/register', [UsersController::class, 'register'])->name('register');
Route::post('/login', [UsersController::class, 'login'])->name('login');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

// Vérification email
Route::get('/auth/emailVerify', [UsersController::class, 'emailVerify'])->name('auth.emailVerify');
Route::post('/auth/verifyCode', [UsersController::class, 'verifyCode'])->name('auth.verifyCode');

// Newsletter
Route::post('/newsletter/subscribe', function () {
    return redirect()->back()->with('success', 'Abonnement réussi !');
})->name('newsletter.subscribe');

// Dashboard selon rôle
Route::get('/dashboard', [RoleController::class, 'redirectDashboard'])->middleware('auth')->name('dashboard');
Route::get('/user.dashboard', fn() => view('user.dashboard'))->name('user.dashboard');
Route::get('/admin.dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');

// Devenir partenaire  page (GET) et soumission formulaire (POST) séparées
Route::get('/partenaire/index', fn() => view('partenaire.index'))->name('partenaire.index');
Route::get('/partenaire.dashboard', fn() => view('partenaire.dashboard'))->name('partenaire.dashboard');

// Formulaire formateur
Route::post('/formateur/inscription', [FormateurController::class, 'registerFormateur'])
     ->name('formateur.register')
     ->middleware('auth');

// Formulaire formation
Route::post('/formation/soumettre', [FormationController::class, 'soumettreFormation'])
     ->name('formation.submit')
     ->middleware('auth');

// Éditeur de formation
Route::get('/formations.editerformation', fn() => view('formations.editerformation'))->name('formations.editerformation');

// Admin - plus de doublon
Route::get('/admin/formation/{id}', [AdminController::class, 'voirFormation'])
     ->name('admin.formation.detail')
     ->middleware('auth');

Route::post('/admin/formation/{id}/valider', [AdminController::class, 'valideFormation'])
     ->name('admin.formation.valider')
     ->middleware('auth');

Route::post('/admin/formation/{id}/rejeter', [AdminController::class, 'rejeterFormation'])
     ->name('admin.formation.rejeter')
     ->middleware('auth');

     //

// Affichage du formulaire et du dashboard partenaire

Route::get('/partenaire.dashboard', fn() => view('partenaire.dashboard'))->name('partenaire.dashboard')->middleware('auth');

// UNIQUE ROUTE POST pour l'enregistrement complet via Laravel
Route::post('/partenaire/soumettre', [PartenaireController::class, 'soumettreTout'])
     ->name('partenaire.soumettre')
     ->middleware('auth');
