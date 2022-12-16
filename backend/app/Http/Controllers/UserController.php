<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageUpload;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();
        return response()->json([
            'success' => true,
            'message' => 'Profile User',
            'data' => $user
        ], 200);
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $data = $request->all();
        if($request->hasFile('foto')) $data['foto'] = ImageUpload::uploadImage($request, 'foto');
        // validate data user
        $validate = Validator::make($data, [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6',
        ]);

        // if validation failed
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validate->errors()
            ], 400);
        }
        
        
        // update data user
        $user = User::find($user->id);
        $user->update($data);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile Updated',
            'data' => $user
        ], 200);


    }
}
