<?php

namespace App\Modules\Users\UseCases;

use App\Modules\Users\Domains\Errors\UserError;
use App\Modules\Users\Domains\Models\User;
use App\Modules\Users\Domains\Repositories\ICreateUserRepository;
use Mockery;
use Tests\TestCase;

class CreateUserTest extends TestCase{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_ユーザーが正常に作成される(){
        $mockRepository = Mockery::mock(ICreateUserRepository::class);

        $mockRepository->shouldReceive('execute')
        ->once()
        ->with(Mockery::on(function(User $user){
            return $user->auth0Id === 'auth0|123456789' &&
                   $user->name === 'John Doe' &&
                   $user->email === 'john.doe@example.com' &&
                   $user->photoUrl === 'https://example.com/photo.jpg';
        }));

        $useCase = new CreateUser($mockRepository);
        $result = $useCase->execute(
            auth0Id: 'auth0|123456789',
            name: 'John Doe',
            email: 'john.doe@example.com',
            photoUrl: 'https://example.com/photo.jpg'
        );

        $this->assertTrue($result->isOk());
    }

    public function test_ユーザーの作成に失敗する(){
        $mockRepository = Mockery::mock(ICreateUserRepository::class);

        $mockRepository->shouldReceive('execute')
        ->never();

        $useCase = new CreateUser($mockRepository);
        $result = $useCase->execute(
            auth0Id: 'auth0|123456789',
            name: 'test user',
            email: '',
            photoUrl: null
        );

        $this->assertTrue($result->isErr());
        $this->assertEquals(UserError::InvalidEmail, $result->unwrapErr());
}
}