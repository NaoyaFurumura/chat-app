<?php

namespace App\Modules\Users\Domains\Errors;

enum UserError {
    case InvalidName;
    case InvalidEmail;
    case UserNotFoundByAuth0Id;
}