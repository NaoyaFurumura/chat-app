<?php

namespace App\BrowserApi;

use App\Modules\Users\Domains\Errors\UserError;
use App\Modules\Users\UseCases\CreateUser;
use App\Modules\Users\UseCases\GetMe;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    public function __construct(
        private readonly GetMe $getMeUseCase,
        private readonly CreateUser $createUserUseCase,
    )
    {
    }

    public function getMe()
    {
        $auth0Id = auth('auth0-api')->id();
        $result = $this->getMeUseCase->execute(auth0Id: $auth0Id);
        if($result->isErr()) {
            return match($result->unwrapErr()) {
                UserError::UserNotFoundByAuth0Id => response()->json(['error' => 'User not found'], 404),
                default => response()->json(['error' => 'An unexpected error occurred'], 500),
            };
        }
        return response()->json($result->unwrap(), 200);
    }

    public function create(){
        $auth0Id = auth('auth0-api')->id();
        $name = request()->input('name');
        $email = request()->input('email');
        $photoUrl = request()->input('photoUrl');

        $result = $this->createUserUseCase->execute(
            auth0Id: $auth0Id,
            name: $name,
            email: $email,
            photoUrl: $photoUrl,
        );

        if($result->isErr()) {
            return match($result->unwrapErr()) {
                UserError::InvalidEmail => response()->json(['error' => 'Invalid email'], 400),
                default => response()->json(['error' => 'An unexpected error occurred'], 500),
            };
        }

        return response()->json($result->unwrap(), 201);
    }
}