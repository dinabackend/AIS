<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{

    public function up(): void
    {
        // Main title
        $this->migrator->add('guarantee.main', []);

        // Guarantee
        $this->migrator->add('guarantee.guarantee', []);

        // Questions
        $this->migrator->add('guarantee.question', []);

        // Defect
        $this->migrator->add('guarantee.defect', []);

    }
};
