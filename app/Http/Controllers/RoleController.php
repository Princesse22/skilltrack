<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function redirectDashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }

        if ($user->role === 'partenaire') {
            return redirect()->route('partenaire.dashboard');
        }

        abort(403, 'Accès non autorisé');
    }

    public function create(): never
    {

    }

    /**
     * Store the newly created resource in storage.
     */
public function store(Request $request)
{
}

    /**
     * Display the resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {

    }
}
