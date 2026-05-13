<!DOCTYPE html>
<html>

<head>
    <title>Advanced App Settings</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body {
            font-family: Arial, sans-serif;

            background:
                {{ setting('theme_mode') == 'light'
                    ? '#f4f4f4'
                    : '#121212' }};

            color:
                {{ setting('theme_mode') == 'light'
                    ? '#000'
                    : '#fff' }};

            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            padding:20px;
        }

        .container {

            background:
                {{ setting('theme_mode') == 'light'
                    ? '#ffffff'
                    : '#1e1e2f' }};

            width:100%;
            max-width:500px;

            padding:30px;

            border-radius:15px;

            box-shadow:0 10px 30px rgba(0,0,0,0.3);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
            color:#00d4ff;
        }

        label{
            display:block;
            margin-top:15px;
            margin-bottom:6px;
            font-weight:bold;
        }

        input,
        select{

            width:100%;
            padding:12px;

            border-radius:8px;

            border:1px solid #444;

            outline:none;

            background:
                {{ setting('theme_mode') == 'light'
                    ? '#f9f9f9'
                    : '#2a2a3d' }};

            color:
                {{ setting('theme_mode') == 'light'
                    ? '#000'
                    : '#fff' }};
        }

        input:focus,
        select:focus{
            border-color:#00d4ff;
            box-shadow:0 0 8px rgba(0,212,255,0.5);
        }

        button{

            width:100%;
            margin-top:25px;

            padding:14px;

            background:#00d4ff;

            color:#000;

            border:none;

            border-radius:8px;

            font-size:16px;

            cursor:pointer;

            font-weight:bold;

            transition:0.3s;
        }

        button:hover{
            background:#00aacc;
        }

        .success{

            background:#1f3d2b;

            color:#4cff9a;

            padding:12px;

            border-radius:8px;

            margin-bottom:20px;

            text-align:center;

            border:1px solid #4cff9a;
        }

        .error{
            color:#ff6b6b;
            font-size:13px;
            margin-top:5px;
        }

        .logo-preview{
            text-align:center;
            margin-bottom:20px;
        }

        .logo-preview img{
            width:100px;
            height:100px;
            object-fit:cover;
            border-radius:12px;
            border:3px solid #00d4ff;
        }

        .setting-box{
            margin-bottom:15px;
        }
    </style>

</head>

<body>

<div class="container">

    <h2>⚙️ Advanced App Settings</h2>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="success">
            ✅ {{ session('success') }}
        </div>

    @endif

    {{-- LOGO PREVIEW --}}
    @if(setting('app_logo'))

        <div class="logo-preview">

            <img
                src="{{ asset('storage/' . setting('app_logo')) }}"
                alt="Logo">

        </div>

    @endif

    <form
        method="POST"
        action="/settings"
        enctype="multipart/form-data">

        @csrf

        {{-- APP NAME --}}
        <div class="setting-box">

            <label>App Name</label>

            <input
                type="text"
                name="app_name"
                value="{{ setting('app_name') }}"
                placeholder="Enter App Name">

            @error('app_name')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>

        {{-- EMAIL --}}
        <div class="setting-box">

            <label>App Email</label>

            <input
                type="email"
                name="app_email"
                value="{{ setting('app_email') }}"
                placeholder="Enter Email">

            @error('app_email')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>

        {{-- USER LIMIT --}}
        <div class="setting-box">

            <label>User Limit</label>

            <input
                type="number"
                name="users_limit"
                value="{{ setting('users_limit') }}"
                placeholder="Enter User Limit">

            @error('users_limit')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>

        {{-- THEME MODE --}}
        <div class="setting-box">

            <label>Theme Mode</label>

            <select name="theme_mode">

                <option value="dark"
                    {{ setting('theme_mode') == 'dark'
                        ? 'selected'
                        : '' }}>
                    Dark
                </option>

                <option value="light"
                    {{ setting('theme_mode') == 'light'
                        ? 'selected'
                        : '' }}>
                    Light
                </option>

            </select>

            @error('theme_mode')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>

        {{-- APP LOGO --}}
        <div class="setting-box">

            <label>App Logo</label>

            <input type="file" name="app_logo">

            @error('app_logo')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>

        <button type="submit">
            💾 Save Settings
        </button>

    </form>

</div>

</body>

</html>