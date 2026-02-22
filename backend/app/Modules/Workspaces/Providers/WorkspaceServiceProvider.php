<?php
namespace App\Modules\Workspaces\Providers;

use App\Modules\Workspaces\Domains\Repositories\ICreateWorkspace;
use App\Modules\Workspaces\Effects\CreateWorkspace;
use Illuminate\Support\ServiceProvider;

class WorkspaceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ICreateWorkspace::class,
            CreateWorkspace::class
        );
    }

}