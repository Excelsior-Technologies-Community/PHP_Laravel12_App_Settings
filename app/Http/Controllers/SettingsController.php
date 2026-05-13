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
        // VALIDATION
        
        $request->validate([
            'app_name' => 'required|min:2|max:50',
            'app_email' => 'required|email',
            'users_limit' => 'required|numeric|min:1',
            'theme_mode' => 'required',
            'app_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // SAVE SETTINGS

        setting()->set('app_name', $request->app_name);

        setting()->set('app_email', $request->app_email);

        setting()->set('users_limit', $request->users_limit);

        setting()->set('theme_mode', $request->theme_mode);

        // LOGO UPLOAD

        if ($request->hasFile('app_logo')) {

            $logo = $request->file('app_logo')
                            ->store('logos', 'public');

            setting()->set('app_logo', $logo);
        }

        return redirect('/settings')
            ->with('success', 'Settings Saved Successfully!');
    }
}