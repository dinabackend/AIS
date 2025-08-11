<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GuaranteePageSettings extends Settings
{
    public string $main_ru;
    public string $main_uz;
    public string $main_en;
    public string $title_ru;
    public string $subtitle_ru;
    public array $repeater_ru;
    public string $title_uz;
    public string $subtitle_uz;
    public array $repeater_uz;
    public string $title_en;
    public string $subtitle_en;
    public array $repeater_en;
    public string $banner;
    public string $question_ru;
    public array $question_list_ru;
    public string $question_uz;
    public array $question_list_uz;
    public string $question_en;
    public array $question_list_en;
    public string $defect_title_ru;
    public array $defect_list_ru;
    public string $defect_question_ru;
    public string $defect_title_uz;
    public array $defect_list_uz;
    public string $defect_question_uz;
    public string $defect_title_en;
    public array $defect_list_en;
    public string $defect_question_en;
    public static function group(): string
    {
        return 'guarantee';
    }
}
