<?php
namespace App\Modules\Users\UseCases;

use App\Modules\Users\Domains\Dtos\UserDto;
use App\Modules\Users\Domains\Repositories\IFindUserByAuth0IdRepository;
use App\Utils\Result;

class GetMe
{
 public function __construct(
     private IFindUserByAuth0IdRepository $getUserByAuth0IdRepository,
 ) {}

/**
 * @param string $auth0Id
 * @return Result<UserDto, UserError>
 */
 public function execute(string $auth0Id): Result
 {
     $result = $this->getUserByAuth0IdRepository->execute($auth0Id);
     if($result->isErr()) {
         return $result;
     }

    $user = $result->unwrap();
    return Result::ok(UserDto::fromDomains($user));
 }
}