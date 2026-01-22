<?php

use App\Settings\GeneralSettings;

if (!function_exists('settings')) {
    /**
     * Truy cập nhanh vào cấu hình GeneralSettings
     */
    function settings()
    {
        return app(GeneralSettings::class);
    }
}
