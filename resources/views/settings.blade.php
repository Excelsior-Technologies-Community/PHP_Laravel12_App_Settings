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