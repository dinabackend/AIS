<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {

    public function up(): void
    {
        $langs = ['uz', 'ru', 'en'];
        $settings = [
            'right_text' => true,
            'left_text' => true,
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
            'contact_main_title' => true,
            'contact_title' => true,
            'contact_subtitle' => true,
            'contact_text1' => true,
            'contact_text2' => true,
            'contact_text3' => true,
        ];

        foreach ($settings as $setting => $translatable) {
            if ($translatable) {
                foreach ($langs as $lang) {
                    $this->migrator->add("general.{$setting}_{$lang}", "test");
                }
            } else {
                $this->migrator->add("general.{$setting}", "test");
            }
        }
    }
};
