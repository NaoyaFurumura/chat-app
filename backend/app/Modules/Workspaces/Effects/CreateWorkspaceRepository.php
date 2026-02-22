<?php
namespace App\Modules\Workspaces\Effects;

use App\Modules\Workspaces\Domains\Models\Workspace;
use App\Modules\Workspaces\Domains\Repositories\ICreateWorkspace;
use App\Modules\Workspaces\Effects\Eloquent\WorkspaceModel;

class CreateWorkspace implements ICreateWorkspace{
    public function execute(Workspace $workspace): void
    {
       WorkspaceModel::create([
            'id' => $workspace->id,
            'name' => $workspace->name,
            'image_url' => $workspace->imageUrl
        ]);
        return;
    }
}