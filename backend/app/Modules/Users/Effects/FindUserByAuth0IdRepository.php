<?php

use App\Modules\Users\Domains\Errors\UserError;
use App\Modules\Users\Domains\Models\User;
use App\Modules\Users\Domains\Repositories\IFindUserByAuth0IdRepository;
use App\Utils\Result;

class FindUserByAuth0IdRepository implements IFindUserByAuth0IdRepository {
    public function execute(string $auth0Id): Result
    {
        $userModel = UserModel::where('auth0_id', $auth0Id)->first();
        if (!$userModel) {
            return Result::err(UserError::UserNotFoundByAuth0Id);
        }

        $user = User::from(
            id: $userModel->id,
            auth0Id: $userModel->auth0_id,
            name: $userModel->name,
            email: $userModel->email,
            photoUrl: $userModel->photo_url,
        );

        return Result::ok($user);
    }
}