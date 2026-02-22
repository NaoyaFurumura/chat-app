<?php

use App\Modules\Users\Domains\Models\User;
use App\Modules\Users\Domains\Repositories\ICreateUserRepository;

class CreateUserRepository implements ICreateUserRepository {
    public function execute(User $user): void
    {
        UserModel::create([
            'id' => $user->id,
            'auth0_id' => $user->auth0Id,
            'name' => $user->name,
            'email' => $user->email,
            'photo_url' => $user->photoUrl,
        ]);
    }
}