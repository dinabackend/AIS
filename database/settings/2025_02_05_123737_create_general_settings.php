<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{

    public function up(): void
    {
        $langs = ['uz', 'ru', 'en'];
        $settings = [
            'footer_title' => true,
            'address' => true,
            'title' => true,
            'text' => true,
            'img' => false,
            'telegram' => false,
            'instagram' => false,
            'linkedin' => false,
            'facebook' => false,
            'mail1' => false,
            'mail2' => false,
            'phone' => false,
        ];

        foreach ($settings as $setting => $translatable) {
            if ($translatable) {
                foreach ($langs as $lang) {
                    $this->migrator->add("general.{$setting}_{$lang}", "null");
                }
            } else {
                $this->migrator->add("general.{$setting}", "null");
            }
        }
    }
};
