<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $footer_text = '';
    public string $search_tags = '';
    public array $footer_menu_1 = [];
    public array $footer_menu_2 = [];
    public array $footer_menu_3 = [];
    public string $facebook;
    public string $tiktok;
    //public string $hotline;
    //public string $address;
    //public ?string $logo; // Để dấu ? vì logo có thể null

    public static function group(): string
    {
        return 'general'; // Tên nhóm trong database
    }
}
