<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Add new settings to the settings table
        $settings = [
            ['key' => 'maintenance_mode', 'value' => 'false'],
            ['key' => 'session_lifetime', 'value' => '120'],
            ['key' => 'registration_enabled', 'value' => 'true'],
            ['key' => 'max_upload_size', 'value' => '2048'],
            ['key' => 'timezone', 'value' => 'UTC'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }

    public function down()
    {
        DB::table('settings')->whereIn('key', [
            'maintenance_mode', 'session_lifetime', 'registration_enabled', 
            'max_upload_size', 'timezone'
        ])->delete();
    }
};