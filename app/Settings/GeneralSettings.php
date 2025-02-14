<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $name;
    public string $description;

    public bool $active;
    public static function group(): string
    {
        return 'general';
    }
}