<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (isset($user) && !empty($user) && Hash::check($request->password, $user->password)) {
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json(['status' => true, 'message' => "You have logged in Successfully", 'data' => [
                'user' => $user,
                'token' => $token,
            ]], 200);
        } else {
            return response()->json(['status' => false, 'message' => "Invalid Email or Password, Please check your credentials and try again!"], 401);
        }
    }
}
