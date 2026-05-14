<!DOCTYPE html>
<html>

<head>
    <title>Advanced App Settings</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: {{ setting('theme_mode') == 'light' ? '#f4f4f4' : '#121212' }};
            color: {{ setting('theme_mode') == 'light' ? '#000' : '#fff' }};
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            padding:20px;
        }

        .container {
            background: {{ setting('theme_mode') == 'light' ? '#ffffff' : '#1e1e2f' }};
            width:100%;
            max-width:650px;
            padding:30px;
            border-radius:15px;
            box-shadow:0 10px 30px rgba(0,0,0,0.3);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
            color:#00d4ff;
        }

        h3{
            color:#00d4ff;
            margin-top:10px;
            margin-bottom:15px;
            font-size:18px;
        }

        label{
            display:block;
            margin-top:15px;
            margin-bottom:6px;
            font-weight:bold;
        }

        input, select, textarea{
            width:100%;
            padding:12px;
            border-radius:8px;
            border:1px solid #444;
            outline:none;
            background: {{ setting('theme_mode') == 'light' ? '#f9f9f9' : '#2a2a3d' }};
            color: {{ setting('theme_mode') == 'light' ? '#000' : '#fff' }};
        }

        input:focus, select:focus, textarea:focus{
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

        button:disabled{
            opacity:0.6;
            cursor:not-allowed;
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

        .grid-2{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:15px;
        }

        .toggle-switch{
            display:flex;
            align-items:center;
            gap:15px;
            padding:10px;
            background: {{ setting('theme_mode') == 'light' ? '#f0f0f0' : '#2a2a3d' }};
            border-radius:8px;
        }

        .toggle-switch label{
            margin:0;
            flex:1;
        }

        .toggle-input{
            width:auto !important;
            margin:0;
        }

        .status-badge{
            display:inline-block;
            padding:5px 12px;
            border-radius:20px;
            font-size:12px;
            font-weight:bold;
            margin-left:10px;
        }

        .status-active{
            background:#4cff9a;
            color:#000;
        }

        .status-inactive{
            background:#ff6b6b;
            color:#fff;
        }

        .live-preview{
            background: {{ setting('theme_mode') == 'light' ? '#f9f9f9' : '#2a2a3d' }};
            border-radius:10px;
            padding:15px;
            margin-bottom:20px;
            border:1px solid #00d4ff;
        }

        .live-preview h4{
            color:#00d4ff;
            margin-bottom:10px;
        }

        .preview-item{
            display:flex;
            justify-content:space-between;
            padding:8px 0;
            border-bottom:1px solid #444;
        }

        .preview-item:last-child{
            border-bottom:none;
        }

        .preview-label{
            font-weight:bold;
        }

        .loading{
            opacity:0.5;
            pointer-events:none;
        }

        hr{
            margin:20px 0;
            border-color:#444;
        }

        small{
            color:#888;
            font-size:11px;
        }

        @media (max-width: 600px){
            .grid-2{
                grid-template-columns:1fr;
            }
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

    {{-- ERROR MESSAGES --}}
    @if($errors->any())
        <div class="success" style="background:#3d1f1f; border-color:#ff6b6b; color:#ff6b6b;">
            ❌ Please fix the errors below
        </div>
    @endif

    {{-- LIVE PREVIEW SECTION --}}
    <div class="live-preview" id="livePreview">
        <h4>🔍 Live Preview</h4>
        <div class="preview-item">
            <span class="preview-label">App Name:</span>
            <span id="previewAppName">{{ setting('app_name') ?: 'Not set' }}</span>
        </div>
        <div class="preview-item">
            <span class="preview-label">Theme:</span>
            <span id="previewTheme">{{ ucfirst(setting('theme_mode')) }}</span>
        </div>
        <div class="preview-item">
            <span class="preview-label">Status:</span>
            <span id="previewStatus">
                @if(setting('maintenance_mode') == 'true')
                    <span class="status-badge status-inactive">🔧 Maintenance Mode</span>
                @else
                    <span class="status-badge status-active">✅ Live</span>
                @endif
            </span>
        </div>
        <div class="preview-item">
            <span class="preview-label">User Limit:</span>
            <span id="previewUserLimit">{{ setting('users_limit') ?: 'Not set' }}</span>
        </div>
        <div class="preview-item">
            <span class="preview-label">Timezone:</span>
            <span id="previewTimezone">{{ setting('timezone') ?: 'UTC' }}</span>
        </div>
        <div class="preview-item">
            <span class="preview-label">Registration:</span>
            <span id="previewRegistration">
                @if(setting('registration_enabled') == 'true')
                    <span class="status-badge status-active">✅ Open</span>
                @else
                    <span class="status-badge status-inactive">🔒 Closed</span>
                @endif
            </span>
        </div>
    </div>

    {{-- LOGO PREVIEW --}}
    @if(setting('app_logo'))
        <div class="logo-preview">
            <img src="{{ asset('storage/' . setting('app_logo')) }}" alt="Logo">
        </div>
    @endif

    <form method="POST" action="/settings" enctype="multipart/form-data" id="settingsForm">
        @csrf

        <div class="grid-2">
            {{-- APP NAME --}}
            <div class="setting-box">
                <label>📱 App Name</label>
                <input type="text" name="app_name" id="app_name" value="{{ old('app_name', setting('app_name')) }}" placeholder="Enter App Name">
                @error('app_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="setting-box">
                <label>📧 App Email</label>
                <input type="email" name="app_email" value="{{ old('app_email', setting('app_email')) }}" placeholder="Enter Email">
                @error('app_email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid-2">
            {{-- USER LIMIT --}}
            <div class="setting-box">
                <label>👥 User Limit</label>
                <input type="number" name="users_limit" id="users_limit" value="{{ old('users_limit', setting('users_limit')) }}" placeholder="Enter User Limit">
                @error('users_limit')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- THEME MODE --}}
            <div class="setting-box">
                <label>🎨 Theme Mode</label>
                <select name="theme_mode" id="theme_mode">
                    <option value="dark" {{ (old('theme_mode', setting('theme_mode')) == 'dark') ? 'selected' : '' }}>🌙 Dark</option>
                    <option value="light" {{ (old('theme_mode', setting('theme_mode')) == 'light') ? 'selected' : '' }}>☀️ Light</option>
                </select>
                @error('theme_mode')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr>

        {{-- NEW SETTINGS SECTION --}}
        <h3>⚡ Advanced Settings</h3>

        <div class="grid-2">
            {{-- MAINTENANCE MODE --}}
            <div class="setting-box">
                <label>🔧 Maintenance Mode</label>
                <select name="maintenance_mode" id="maintenance_mode">
                    <option value="false" {{ (old('maintenance_mode', setting('maintenance_mode')) == 'false') ? 'selected' : '' }}>❌ Disabled</option>
                    <option value="true" {{ (old('maintenance_mode', setting('maintenance_mode')) == 'true') ? 'selected' : '' }}>⚠️ Enabled</option>
                </select>
                <small>When enabled, only admins can access the site</small>
                @error('maintenance_mode')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- REGISTRATION STATUS --}}
            <div class="setting-box">
                <label>📝 User Registration</label>
                <select name="registration_enabled" id="registration_enabled">
                    <option value="true" {{ (old('registration_enabled', setting('registration_enabled')) == 'true') ? 'selected' : '' }}>✅ Enabled</option>
                    <option value="false" {{ (old('registration_enabled', setting('registration_enabled')) == 'false') ? 'selected' : '' }}>❌ Disabled</option>
                </select>
                <small>Allow new users to register</small>
                @error('registration_enabled')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="grid-2">
            {{-- SESSION LIFETIME --}}
            <div class="setting-box">
                <label>⏱️ Session Lifetime (minutes)</label>
                <input type="number" name="session_lifetime" value="{{ old('session_lifetime', setting('session_lifetime', '120')) }}" placeholder="Session Lifetime" min="1" max="525600">
                @error('session_lifetime')
                    <div class="error">{{ $message }}</div>
                @enderror
                <small>Default: 120 minutes (2 hours)</small>
            </div>

            {{-- MAX UPLOAD SIZE --}}
            <div class="setting-box">
                <label>📎 Max Upload Size (KB)</label>
                <input type="number" name="max_upload_size" value="{{ old('max_upload_size', setting('max_upload_size', '2048')) }}" placeholder="Max Upload Size" min="512" max="102400">
                @error('max_upload_size')
                    <div class="error">{{ $message }}</div>
                @enderror
                <small>Default: 2048 KB (2MB)</small>
            </div>
        </div>

        {{-- TIMEZONE --}}
        <div class="setting-box">
            <label>🌐 Timezone</label>
            <select name="timezone" id="timezone">
                <option value="UTC" {{ (old('timezone', setting('timezone')) == 'UTC') ? 'selected' : '' }}>UTC</option>
                <option value="America/New_York" {{ (old('timezone', setting('timezone')) == 'America/New_York') ? 'selected' : '' }}>America/New_York (EST/EDT)</option>
                <option value="America/Chicago" {{ (old('timezone', setting('timezone')) == 'America/Chicago') ? 'selected' : '' }}>America/Chicago (CST/CDT)</option>
                <option value="America/Denver" {{ (old('timezone', setting('timezone')) == 'America/Denver') ? 'selected' : '' }}>America/Denver (MST/MDT)</option>
                <option value="America/Los_Angeles" {{ (old('timezone', setting('timezone')) == 'America/Los_Angeles') ? 'selected' : '' }}>America/Los_Angeles (PST/PDT)</option>
                <option value="Europe/London" {{ (old('timezone', setting('timezone')) == 'Europe/London') ? 'selected' : '' }}>Europe/London</option>
                <option value="Europe/Paris" {{ (old('timezone', setting('timezone')) == 'Europe/Paris') ? 'selected' : '' }}>Europe/Paris</option>
                <option value="Asia/Kolkata" {{ (old('timezone', setting('timezone')) == 'Asia/Kolkata') ? 'selected' : '' }}>Asia/Kolkata (IST)</option>
                <option value="Asia/Tokyo" {{ (old('timezone', setting('timezone')) == 'Asia/Tokyo') ? 'selected' : '' }}>Asia/Tokyo (JST)</option>
                <option value="Australia/Sydney" {{ (old('timezone', setting('timezone')) == 'Australia/Sydney') ? 'selected' : '' }}>Australia/Sydney (AEDT/AEST)</option>
            </select>
            @error('timezone')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        {{-- APP LOGO --}}
        <div class="setting-box">
            <label>🖼️ App Logo</label>
            <input type="file" name="app_logo" accept="image/jpeg,image/png,image/jpg">
            @error('app_logo')
                <div class="error">{{ $message }}</div>
            @enderror
            <small>Max size: {{ setting('max_upload_size', '2048') }} KB</small>
        </div>

        <button type="submit" id="submitBtn">
            💾 Save All Settings
        </button>

    </form>

</div>

<script>
    // Get form elements
    const appNameInput = document.getElementById('app_name');
    const themeModeSelect = document.getElementById('theme_mode');
    const maintenanceModeSelect = document.getElementById('maintenance_mode');
    const userLimitInput = document.getElementById('users_limit');
    const timezoneSelect = document.getElementById('timezone');
    const registrationEnabledSelect = document.getElementById('registration_enabled');
    const form = document.getElementById('settingsForm');
    const submitBtn = document.getElementById('submitBtn');

    // Preview elements
    const previewAppName = document.getElementById('previewAppName');
    const previewTheme = document.getElementById('previewTheme');
    const previewStatus = document.getElementById('previewStatus');
    const previewUserLimit = document.getElementById('previewUserLimit');
    const previewTimezone = document.getElementById('previewTimezone');
    const previewRegistration = document.getElementById('previewRegistration');

    // Function to update live preview
    function updateLivePreview() {
        // Update App Name
        previewAppName.textContent = (appNameInput && appNameInput.value.trim()) || 'Not set';
        
        // Update Theme
        if (themeModeSelect) {
            const themeValue = themeModeSelect.value;
            previewTheme.textContent = themeValue === 'light' ? 'Light' : 'Dark';
        }
        
        // Update Status based on maintenance mode
        if (maintenanceModeSelect) {
            const maintenanceValue = maintenanceModeSelect.value;
            if (maintenanceValue === 'true') {
                previewStatus.innerHTML = '<span class="status-badge status-inactive">🔧 Maintenance Mode</span>';
            } else {
                previewStatus.innerHTML = '<span class="status-badge status-active">✅ Live</span>';
            }
        }
        
        // Update User Limit
        if (userLimitInput) {
            previewUserLimit.textContent = userLimitInput.value || 'Not set';
        }
        
        // Update Timezone
        if (timezoneSelect) {
            const timezoneValue = timezoneSelect.options[timezoneSelect.selectedIndex]?.text || 'UTC';
            previewTimezone.textContent = timezoneValue;
        }
        
        // Update Registration Status
        if (registrationEnabledSelect) {
            const regValue = registrationEnabledSelect.value;
            if (regValue === 'true') {
                previewRegistration.innerHTML = '<span class="status-badge status-active">✅ Open</span>';
            } else {
                previewRegistration.innerHTML = '<span class="status-badge status-inactive">🔒 Closed</span>';
            }
        }
    }

    // Function to update theme on the fly
    function updatePageTheme() {
        if (!themeModeSelect) return;
        
        const theme = themeModeSelect.value;
        const body = document.body;
        const container = document.querySelector('.container');
        const inputs = document.querySelectorAll('input, select, textarea');
        const livePreview = document.querySelector('.live-preview');
        
        if (theme === 'light') {
            body.style.background = '#f4f4f4';
            body.style.color = '#000';
            if (container) container.style.background = '#ffffff';
            if (livePreview) livePreview.style.background = '#f9f9f9';
            inputs.forEach(input => {
                input.style.background = '#f9f9f9';
                input.style.color = '#000';
            });
        } else {
            body.style.background = '#121212';
            body.style.color = '#fff';
            if (container) container.style.background = '#1e1e2f';
            if (livePreview) livePreview.style.background = '#2a2a3d';
            inputs.forEach(input => {
                input.style.background = '#2a2a3d';
                input.style.color = '#fff';
            });
        }
    }

    // Add event listeners for real-time preview
    if (appNameInput) appNameInput.addEventListener('input', updateLivePreview);
    if (themeModeSelect) themeModeSelect.addEventListener('change', () => {
        updateLivePreview();
        updatePageTheme();
    });
    if (maintenanceModeSelect) maintenanceModeSelect.addEventListener('change', updateLivePreview);
    if (userLimitInput) userLimitInput.addEventListener('input', updateLivePreview);
    if (timezoneSelect) timezoneSelect.addEventListener('change', updateLivePreview);
    if (registrationEnabledSelect) registrationEnabledSelect.addEventListener('change', updateLivePreview);

    // Add loading state on form submit
    if (form) {
        form.addEventListener('submit', function() {
            if (submitBtn) {
                submitBtn.innerHTML = '⏳ Saving Settings...';
                submitBtn.disabled = true;
            }
            document.body.classList.add('loading');
        });
    }

    // Initialize preview on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateLivePreview();
        updatePageTheme();
        
        // Show warnings in console
        if (maintenanceModeSelect && maintenanceModeSelect.value === 'true') {
            console.log('⚠️ Maintenance mode is currently enabled');
        }
        
        if (registrationEnabledSelect && registrationEnabledSelect.value === 'false') {
            console.log('⚠️ User registration is currently disabled');
        }
    });
</script>

</body>

</html>