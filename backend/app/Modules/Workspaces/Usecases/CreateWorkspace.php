<?php
namespace App\Modules\Workspaces\UseCases;

use App\Modules\Workspaces\Domains\Dtos\WorkspaceDto;
use App\Modules\Workspaces\Domains\Models\Workspace;
use App\Modules\Workspaces\Domains\Repositories\ICreateWorkspace;
use App\Utils\Result;

class CreateWorkspace {
    private ICreateWorkspace $createWorkspaceRepository;

    public function __construct(ICreateWorkspace $createWorkspaceRepository) {
        $this->createWorkspaceRepository = $createWorkspaceRepository;
    }

    public function execute(string $name, string $imageUrl): Result {
        $workspaceResult = Workspace::create($name, $imageUrl);
        if($workspaceResult->isErr()) {
            return Result::err($workspaceResult->unwrapErr());
        }
        $workspace = $workspaceResult->unwrap();
        $this->createWorkspaceRepository->execute($workspace);
        return Result::ok(WorkspaceDto::fromDomain($workspace));
    }
}