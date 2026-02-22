<?php

namespace App\Modules\Workspaces\Domains\Models;

use App\Modules\Workspaces\Domains\Errors\WorkspaceError;
use App\Utils\Result;
use Illuminate\Support\Str;

class Workspace {
    readonly string $id;
    readonly string $name;
    readonly string $imageUrl;

    private function __construct(string $id, string $name, string $imageUrl) {
        $this->id = $id;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
    }
    
    /**
        * @return Result<Workspace, WorkspaceError>
    */
    public static function create(string $name, string $imageUrl): Result {
        if(strlen($name) === 0 || strlen($name) > 30) {
            return Result::err(WorkspaceError::InvalidName);
        }
        $id = Str::uuid()->toString();
        return Result::ok(new self(id: $id, name: $name, imageUrl: $imageUrl));
    }
}