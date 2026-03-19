# PHP_Laravel12_App_Settings


## Project Description

PHP_Laravel12_App_Settings is a Laravel 12 application that demonstrates how to manage dynamic application settings using the qcod/laravel-app-settings package.

This project allows users to store and update settings like application name, email, and user limits through a simple UI. All settings are stored in the database and can be accessed anywhere in the application.

It is useful for building admin panels or applications where configuration values need to be changed without modifying code.



## Features

- Dynamic application settings management

- Store settings in database (key-value format)

- Simple and clean UI (Dark Mode design )

- Form validation with error messages

- Success message after saving settings

- Easy access to settings using helper function

- No need to modify .env for dynamic values

- Beginner-friendly implementation


## Key Learning Points

- How to install and use Laravel packages

- How to store dynamic data in database

- Difference between .env and database settings

- Form validation in Laravel

- MVC structure (Model-View-Controller)

- Using helper functions in Laravel



## Technologies Used

1. PHP 8.2 → Backend programming language

2. Laravel 12 → PHP framework for web development

3. MySQL → Database to store settings

4. Blade Template Engine → Frontend rendering

5. CSS (Dark Mode UI) → Styling and design

6. Composer → Dependency management

7. qcod/laravel-app-settings → Package for managing app settings


## How It Works

1. Settings fields are defined in config/app_settings.php  
2. User enters data in the form  
3. Controller validates the input  
4. Data is saved in database using setting() helper  
5. Settings can be accessed anywhere using setting('key')  
6. UI updates automatically with saved values  



---



## Installation Steps


---


## STEP 1: Create Laravel 12 Project

### Open terminal / CMD and run:

```
composer create-project laravel/laravel PHP_Laravel12_App_Settings "12.*"

```

### Go inside project:

```
cd PHP_Laravel12_App_Settings

```

#### Explanation:

This step installs a fresh Laravel 12 project using Composer. It creates a new application where all your code will be written.




## STEP 2: Database Setup 

### Update database details:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12_App_Settings
DB_USERNAME=root
DB_PASSWORD=

```

### Create database in MySQL / phpMyAdmin:

```
Database name: laravel12_App_Settings

```

### Then Run:

```
php artisan migrate

```


#### Explanation:

This step connects Laravel with the MySQL database by updating the .env file.

Running php artisan migrate creates the default Laravel tables required for the application.





## STEP 3: Install Laravel Package

### Install package:

```
composer require qcod/laravel-app-settings

```

### Publish Package Files

```
php artisan vendor:publish --provider="QCod\AppSettings\AppSettingsServiceProvider"

```

### Then Run:

```
php artisan migrate

```



#### Explanation:

This step installs the qcod/laravel-app-settings package which allows dynamic settings management.

Publishing the package creates configuration and migration files, and running migrate creates the settings table in the database.





## STEP 4: Configure Settings

### Open file: config/app_settings.php

```
return [

    'settings' => [

        'general' => [

            'title' => 'General Settings',

            'elements' => [

                [
                    'name' => 'app_name',
                    'type' => 'text',
                    'label' => 'App Name',
                    'rules' => 'required|min:2|max:50',
                    'value' => 'My Laravel App',
                ],

                [
                    'name' => 'app_email',
                    'type' => 'email',
                    'label' => 'App Email',
                    'rules' => 'required|email',
                    'value' => 'admin@example.com',
                ],

                [
                    'name' => 'users_limit',
                    'type' => 'number',
                    'label' => 'Users Limit',
                    'rules' => 'required|numeric|min:1',
                    'value' => 100,
                ],

            ],

        ],

    ],

];

```

#### Explanation:

In this step, you define all settings fields (like app name, email, user limit). These fields are used to generate and manage settings dynamically.





## STEP 5: Add Route

### Open: routes/web.php

```
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/settings', [SettingsController::class, 'index']);
Route::post('/settings', [SettingsController::class, 'store']);

```

#### Explanation:

Routes connect URLs with controller methods. Here, /settings is used to display and save application settings.




## STEP 6: Create Controller 

### Create custom controller:

```
php artisan make:controller SettingsController

```

### File: app/Http/Controllers/SettingsController.php

```
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

```

#### Explanation:

The controller handles form submission. 

It validates user input and stores settings into the database using the setting() helper function.




## STEP 7: Blade View

### resources/views/settings.blade.php

```
<!DOCTYPE html>
<html>

<head>
    <title>App Settings</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #121212;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background: #1e1e2f;
            padding: 30px;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00d4ff;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
            margin-bottom: 5px;
            color: #ccc;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #333;
            background: #2a2a3d;
            color: #fff;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #00d4ff;
            box-shadow: 0 0 8px rgba(0, 212, 255, 0.5);
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #00d4ff;
            color: #000;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: bold;
        }

        button:hover {
            background: #00aacc;
        }

        .success {
            background: #1f3d2b;
            color: #4cff9a;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
            border: 1px solid #4cff9a;
            animation: fadeIn 0.5s ease-in-out;
        }

        .error {
            color: #ff6b6b;
            font-size: 13px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>⚙️ App Settings</h2>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="success">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/settings">
            @csrf

            {{-- App Name --}}
            <label>App Name</label>
            <input type="text" name="app_name" value="{{ old('app_name') }}" placeholder="Enter app name">
            @error('app_name')
                <div class="error">{{ $message }}</div>
            @enderror

            {{-- Email --}}
            <label>Email</label>
            <input type="email" name="app_email" value="{{ old('app_email') }}" placeholder="Enter email">
            @error('app_email')
                <div class="error">{{ $message }}</div>
            @enderror

            {{-- User Limit --}}
            <label>User Limit</label>
            <input type="number" name="users_limit" value="{{ old('users_limit') }}" placeholder="Enter limit">
            @error('users_limit')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">💾 Save Settings</button>

        </form>

    </div>

</body>

</html>

```

#### Explanation:

This is the frontend UI where users can enter and update settings. It includes form inputs, validation errors, and success messages.





## STEP 8: Run the App  

### Start dev server:

```
php artisan serve

```

### Open in browser:

```
http://127.0.0.1:8000/settings

```

#### Explanation:

This starts the Laravel development server. You can open the given URL in a browser to view and test the settings page.





## Application Output


### Settings Page UI:


<img src="screenshots/Screenshot 2026-03-19 142227.png" width="900">


### Form Input Example:


<img src="screenshots/Screenshot 2026-03-19 142124.png" width="900">


### Success Message After Saving:


<img src="screenshots/Screenshot 2026-03-19 142145.png" width="900">




---

## Project Folder Structure:

```
PHP_Laravel12_App_Settings/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── SettingsController.php    (Your controller)
│   │
│   └── Models/
│
├── bootstrap/
│
├── config/
│   ├── app.php
│   ├── database.php
│   └── app_settings.php                 (Package config)
│
├── database/
│   ├── factories/
│   ├── migrations/
│   │   ├── xxxx_create_users_table.php
│   │   ├── xxxx_create_sessions_table.php
│   │   └── xxxx_create_settings_table.php  (IMPORTANT)
│   │
│   └── seeders/
│
├── public/
│   └── index.php
│
├── resources/
│   ├── views/
│   │   ├── settings.blade.php           (Your UI)
│   │   └── welcome.blade.php
│   │
│   ├── css/
│   ├── js/
│
├── routes/
│   └── web.php                         (Routes)
│
├── storage/
│
├── tests/
│
├── vendor/                             (Installed packages)
│
├── .env                                (DB config)
├── artisan
├── composer.json
└── package.json

```

