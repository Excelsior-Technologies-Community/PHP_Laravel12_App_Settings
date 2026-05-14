<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

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
            'theme_mode' => 'required|in:light,dark',
            'app_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            
            // NEW VALIDATION RULES
            'maintenance_mode' => 'required|in:true,false',
            'session_lifetime' => 'required|numeric|min:1|max:525600',
            'registration_enabled' => 'required|in:true,false',
            'max_upload_size' => 'required|numeric|min:512|max:102400',
            'timezone' => 'required|string',
        ]);

        // SAVE SETTINGS
        setting()->set('app_name', $request->app_name);
        setting()->set('app_email', $request->app_email);
        setting()->set('users_limit', $request->users_limit);
        setting()->set('theme_mode', $request->theme_mode);

        // NEW SAVE SETTINGS
        setting()->set('maintenance_mode', $request->maintenance_mode);
        setting()->set('session_lifetime', $request->session_lifetime);
        setting()->set('registration_enabled', $request->registration_enabled);
        setting()->set('max_upload_size', $request->max_upload_size);
        setting()->set('timezone', $request->timezone);

        // Apply maintenance mode if changed
        try {
            if ($request->maintenance_mode === 'true') {
                if (!file_exists(base_path('storage/framework/down'))) {
                    Artisan::call('down', ['--retry' => 60]);
                }
            } else {
                if (file_exists(base_path('storage/framework/down'))) {
                    Artisan::call('up');
                }
            }
        } catch (\Exception $e) {
            // Handle error silently
        }

        // Clear cache to apply new settings
        Cache::flush();

        // LOGO UPLOAD
        if ($request->hasFile('app_logo')) {
            $logo = $request->file('app_logo')->store('logos', 'public');
            setting()->set('app_logo', $logo);
        }

        return redirect('/settings')
            ->with('success', 'Settings Saved Successfully!');
    }
}