<?php

namespace App\Modules\Workspaces\UseCases;

use App\Modules\Workspaces\Domains\Errors\WorkspaceError;
use App\Modules\Workspaces\Domains\Models\Workspace;
use App\Modules\Workspaces\Domains\Repositories\ICreateWorkspace;
use PHPUnit\Framework\TestCase;

class CreateWorkspaceTest extends TestCase {
    public function test_ワークスペース名が規定数以上であればエラーになること() {
        $mockRepository = $this->createMock(ICreateWorkspace::class);
        $useCase = new CreateWorkspace(createWorkspaceRepository: $mockRepository);

        $result = $useCase->execute(name: str_repeat('a', 31), imageUrl: 'https://example.com/image.png');

        $this->assertTrue($result->isErr());
        $this->assertSame(WorkspaceError::InvalidName, $result->unwrapErr());
    }

    public function test_ワークスペースが正常に作成されること() {
        $mockRepository = $this->createMock(ICreateWorkspace::class);
        $mockRepository->expects($this->once())
        ->method('execute')
        ->with(
            $this->callback(function (Workspace $workspace){
                return $workspace->name === 'Test Workspace' &&
                    $workspace->imageUrl === 'https://example.com/image.png';
            })
        );

        $useCase = new CreateWorkspace(createWorkspaceRepository: $mockRepository);
        $result = $useCase->execute(name: 'Test Workspace', imageUrl: 'https://example.com/image.png');

        $this-> assertTrue($result->isOk());
        $workspaceDto = $result->unwrap();
        $this->assertIsString($workspaceDto->id);
        $this->assertSame('Test Workspace', $workspaceDto->name);
        $this->assertSame('https://example.com/image.png', $workspaceDto->imageUrl);
    }
}