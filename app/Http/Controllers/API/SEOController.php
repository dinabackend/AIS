<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Settings\SeoPageSettings;

class SEOController extends Controller
{
    public function index()
    {
        $seoSettings = app(SeoPageSettings::Class);
        return response()->json($seoSettings->toArray());
    }
}
