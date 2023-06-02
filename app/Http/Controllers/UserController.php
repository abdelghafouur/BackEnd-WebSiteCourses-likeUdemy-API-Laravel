<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            // Exclude the password field from the response
            $user->makeHidden('password');

            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $data = $request->all();
    
            if (isset($data['image'])) {
                $imageData = $data['image'];
                // Extract the base64-encoded image data
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                // Decode the base64-encoded image data
                $decodedImage = base64_decode($imageData);
    
                // Generate a unique filename for the image
                $filename = uniqid() . '.jpg';
                // Define the path where the image will be stored
                $imagePath = 'public/images/' . $filename;
                $imageName =  $filename;
                // Save the image file
                Storage::put($imagePath, $decodedImage);
    
                // Update the image path in the data array
                $data['image'] = $imageName;
            }
    
            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }
    
            $user->update($data);
    
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update user profile'], 500);
        }
    }
    

    

}
