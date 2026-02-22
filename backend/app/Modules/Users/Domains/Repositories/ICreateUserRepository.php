<?php

namespace App\Modules\Users\Domains\Repositories;

use App\Modules\Users\Domains\Models\User;

interface ICreateUserRepository {
    public function execute(User $user): void;
}