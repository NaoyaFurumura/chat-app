<?php
namespace App\Modules\Workspaces\Domains\Dtos;
use App\Modules\Workspaces\Domains\Models\Workspace;

class WorkspaceDto {
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $imageUrl
    )
    {
    }

    public static function fromDomain(Workspace $workspace): self {
        return new self(
            $workspace->id,
            $workspace->name,
            $workspace->imageUrl
        );
    }
}