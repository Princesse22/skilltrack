<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{
    public function showRegisterLogin()
    {
            $user = Users::find(session('verify_user_id'));

    if (!$user) {
        return redirect()->route('welcome')
            ->with('error', 'Session expirée.');
    }
        return view('welcome');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $users = users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        session(['verify_user_id' => $users->id]);

        // Generer le code aléatoire
        $code = rand(100000, 999999);

        // Expirer après 10 minutes
        $expiration = now()->addMinutes(10);

        // Enregistrer le code et l'expiration dans la base de données
        $users->verification_code = $code;
        $users->code_expires_at = $expiration;
        $users->save();

        // Envoyer le code par mail
        Mail::to($users->email)->send(new VerificationCodeMail($users, $code));

        return redirect()->route('welcome')->with('showLogin', true)->with('success', 'Inscription réussie, connectez-vous!');
    }
public function verifyCode(Request $request)
{
    $user = users::find(session('verify_user_id'));

    if (!$user) {
        return redirect()->route('welcome')->with('error', 'Session expirée.');
    }

    $code = $request->input('code');

    if ((string)$user->verification_code === (string)$code
        && now()->lessThan($user->code_expires_at)) {

        $user->is_verified = true;
        $user->verification_code = null;
        $user->code_expires_at = null;
        $user->save();

        return redirect()->route('welcome')
            ->with('success', 'Votre identité a été vérifiée !');
    }

    return back()->withErrors(['code' => 'Code incorrect ou expiré.']);
}


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->route('auth.emailVerify')->with('success', 'Connexion réussie');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }
    // si l'utilisateur n'est pas connecter, on le renvoie sur le formulaire de connexion. pour avoir acces a devenir partenaire
public function btnPartenaire(Request $request)
{
    if (!auth()->check() && $request->input('partenaire')) {
        return redirect()->route('welcome')->with('showlogin', true);
    } else {
        //sinon, on le renvoie sur partenaire.index
        return redirect()->route('partner.index');
    }
}


public function emailVerify()
{
    $user = users::find(session('verify_user_id'));

    if (!$user) {
        return redirect()->route('welcome')->with('error', 'Session expirée.');
    }

    return view('auth.emailVerify', compact('user'));
}
    // Les méthodes suivantes sont vides par défaut, vous pouvez les remplir selon vos besoins

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(users $users)
    {
        //
    }

    public function edit(users $users)
    {
        //
    }

    public function update(Request $request, users $users)
    {
        //
    }

    public function destroy(users $users)
    {
        //
    }
}
