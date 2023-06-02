<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    

public function getImage($filename)
{
    $path = 'public/images/' . $filename;

    if (Storage::exists($path)) {
        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
    }

    return response()->json(['message' => 'Image not found'], 404);
}

}
