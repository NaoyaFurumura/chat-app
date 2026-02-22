<?php
namespace App\Modules\Workspaces\Domains\Repositories;
use App\Modules\Workspaces\Domains\Models\Workspace;

interface ICreateWorkspace {
    public function execute(Workspace $workspace): void;
}