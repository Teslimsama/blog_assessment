<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Services\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\V1\LoginRequest;

class LoginController extends Controller
{

    // Handle User Login Request
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)
                    ->first();

        // Check User and User Password
        if ( $user !== null && Hash::check($request->password, $user->password) ) {


            $token = $user->createToken('user-token')->plainTextToken;

            return HttpResponse::send([
                'data' => new UserResource($user),
                'status' => 'sucess',
                'token' => $token
            ], 200);
        }
        else {
            return HttpResponse::send([
                'message' => 'Invalid Credentials',
                'status' => 'error'
            ], 401);
        }
    }
}
