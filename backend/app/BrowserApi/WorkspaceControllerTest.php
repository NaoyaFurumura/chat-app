<?php

namespace App\BrowserApi;

use App\Modules\Workspaces\Domains\Dtos\WorkspaceDto;
use App\Modules\Workspaces\Domains\Errors\WorkspaceError;
use App\Modules\Workspaces\UseCases\CreateWorkspace;
use App\Utils\Result;
use Tests\TestCase;

class WorkspaceControllerTest extends TestCase
{
   public function test_ワークスペースが正常に作成される(): void
   {
    $mock = $this->createMock(CreateWorkspace::class);
    $mock->method('execute')
    ->willReturn(
        Result::ok(new WorkspaceDto('workspace-uuid', 'Test Workspace', 'https://example.com/image.png'))
    );
    $this->app->instance(CreateWorkspace::class, $mock);

    $response = $this->withoutMiddleware()->postJson('/api/workspaces', [
        'name' => 'Test Workspace',
        'image_url' => 'https://example.com/image.png'
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'id' => 'workspace-uuid',
            'name' => 'Test Workspace',
            'imageUrl' => 'https://example.com/image.png'
        ]);
   }

   public function test_ワークスペースの作成に失敗する(): void
   {
   $mock = $this->createMock(CreateWorkspace::class);
   $mock->method('execute')->willReturn(
    Result::err(WorkspaceError::InvalidName)
   );

   $this->app->instance(CreateWorkspace::class, $mock);

   $response = $this->withoutMiddleware()->postJson('/api/workspaces', [
    'name' => '',
    'image_url' => 'https://example.com/image.png'
   ]);

    $response->assertStatus(400)
     ->assertJson([
          'error_code' => 'invalid_workspace_name'
     ]);
   }
}