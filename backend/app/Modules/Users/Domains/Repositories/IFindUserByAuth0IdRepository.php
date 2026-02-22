<?php
namespace App\Modules\Users\Domains\Repositories;

use App\Modules\Users\Domains\Models\User;
use App\Utils\Result;

interface IFindUserByAuth0IdRepository {
    /**
     * @param string $auth0Id
     * @return Result<User, UserError>
     */
    public function execute(string $auth0Id): Result;
}