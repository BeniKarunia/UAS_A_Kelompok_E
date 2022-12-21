<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class ImageUpload
{
    public static function uploadImage($request, $key)
    {
        $request->validate([
            $key => 'required|image'
        ]);

        $imageName = time() . '.' . $request->{$key}->extension();
        $request->{$key}->move(public_path('images'), $imageName);

        return url('/images/' . $imageName);
    }
}
