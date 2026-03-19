<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'app_name' => 'required',
            'app_email' => 'required|email',
            'users_limit' => 'required|numeric|min:1'
        ]);

        // ✅ Save into DB
        setting()->set('app_name', $request->app_name);
        setting()->set('app_email', $request->app_email);
        setting()->set('users_limit', $request->users_limit);

        // ✅ Redirect (clears form)
        return redirect('/settings')->with('success', 'Settings Saved!');
    }
}