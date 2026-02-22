<?php
namespace App\Modules\Users\Domains\Dtos;

use App\Modules\Users\Domains\Models\User;

class UserDto {
    public function __construct(
        public readonly string $auth0Id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $photoUrl,
    ) {}

    public static function fromDomains(User $user): self {
        return new self(
            auth0Id: $user->id,
            name: $user->name,
            email: $user->email,
            photoUrl: $user->photoUrl,
        );
    }
}