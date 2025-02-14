<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.name', 'Fadgram blog');
        $this->migrator->add('general.description', 'Spatie');
        $this->migrator->add('general.active', true);
    }
};
