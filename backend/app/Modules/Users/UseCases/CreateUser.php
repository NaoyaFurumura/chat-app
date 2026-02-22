<?php

namespace App\Modules\Users\UseCases;

use App\Modules\Users\Domains\Models\User;
use App\Modules\Users\Domains\Repositories\ICreateUserRepository;
use App\Utils\Result;

class CreateUser {
    public function __construct(
        private readonly ICreateUserRepository $createUserRepository
    )
    {
    }

    /**
     * @return Result<void, UserError>
     */
    public function execute(
        string $auth0Id,
        string $name,
        string $email,
        ?string $photoUrl,
    ): Result {
        $user = User::create(
            auth0Id: $auth0Id,
            name: $name,
            email: $email,
            photoUrl: $photoUrl,
        );
        if($user->isErr()) {
            return $user;
        }
       $this->createUserRepository->execute($user->unwrap());
        return Result::ok(null);
    }
}