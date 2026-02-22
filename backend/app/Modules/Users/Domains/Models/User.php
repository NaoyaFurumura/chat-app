<?php

namespace App\Modules\Users\Domains\Models;

use App\Modules\Users\Domains\Errors\UserError;
use App\Utils\Result;
use Illuminate\Support\Str;

class User {
    readonly string $id;
    readonly string $auth0Id;
    readonly string $name;
    readonly string $email;
    readonly ?string $photoUrl;

    private function __construct(string $id, string $auth0Id, string $name, string $email, ?string $photoUrl) {
        $this->id = $id;
        $this->auth0Id = $auth0Id;
        $this->name = $name;
        $this->email = $email;
        $this->photoUrl = $photoUrl;
    }

        /**
        * @return Result<User, UserError>
        */
    public static function create(string $auth0Id, string $name, string $email, ?string $photoUrl): Result {
        if(strlen($name) === 0 || strlen($name) > 30) {
            return Result::err(UserError::InvalidName);
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return Result::err(UserError::InvalidEmail);
        }

        $id = Str::uuid()->toString();
        return Result::ok(new self(id: $id, auth0Id: $auth0Id, name: $name, email: $email, photoUrl: $photoUrl));
    }

    public static function from(string $id, string $auth0Id, string $name, string $email, ?string $photoUrl): self {
        return new self(id: $id, auth0Id: $auth0Id, name: $name, email: $email, photoUrl: $photoUrl);
    }
}