<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;

class Settings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settings = ['product'];
        foreach ($settings as $setting) {
            foreach (['ru', 'uz', 'en'] as $lang) {
                $add = new Setting();
                $add->group = 'seo';
                $add->name = "{$setting}_title_$lang";
                $add->locked = false;
                $add->payload = json_encode("");
                $add->save();
                $add = new Setting();
                $add->group = 'seo';
                $add->name = "{$setting}_description_$lang";
                $add->locked = false;
                $add->payload = json_encode("");
                $add->save();
            }
            $add = new Setting();
            $add->group = 'seo';
            $add->name = "{$setting}_img";
            $add->locked = false;
            $add->payload = json_encode("");
            $add->save();
        }

    }
}
