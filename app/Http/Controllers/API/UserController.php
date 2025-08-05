<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Specialist;
use App\Models\User;

class UserController extends Controller
{
    public function index($locale = 'en') {

        (in_array($locale, ['ru', 'uz', 'en'])) ? app()->setLocale($locale) : app()->setLocale('en');

        return response()->json([
            'data' => new UserResource([])
        ]);

    }

    public function show($locale, $id)
    {
        $user = Specialist::query()->findOrFail($id);
        $translated_user = $user->translate($locale);
        return response()->json([
            'data' => [
                'id' => $translated_user->id,
                'name' => $translated_user->name,
                'position' => $translated_user->position,
                'description' => $translated_user->description,
                'image' => $user->getFirstMediaUrl('specialists'),
                //'images' => $translated_user->getMedia('team')->pluck('original_url'),
            ]
        ]);

    }
}
