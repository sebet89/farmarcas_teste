<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\UserService;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserServiceTest extends TestCase
{
    protected $mockUserRepo;
    protected $userService;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockUserRepo = $this->createMock(UserRepositoryInterface::class);
        $this->userService = new UserService($this->mockUserRepo);
        $this->user = $this->createMock(User::class);
    }

    public function test_can_create_user()
    {
        $this->mockUserRepo->expects($this->once())
            ->method('create')
            ->willReturn($this->user);

        $user = $this->userService->createUser([]);

        $this->assertSame($this->user, $user);
    }

    public function test_can_update_user()
    {
        $this->mockUserRepo->expects($this->once())
            ->method('update')
            ->willReturn($this->user);

        $user = $this->userService->updateUser([], 1);

        $this->assertSame($this->user, $user);
    }

    public function test_can_delete_user()
    {
        $this->mockUserRepo->expects($this->once())
            ->method('delete')
            ->willReturn(true);

        $result = $this->userService->deleteUser(1);

        $this->assertTrue($result);
    }

    public function test_can_find_user()
    {
        $this->mockUserRepo->expects($this->once())
            ->method('find')
            ->willReturn($this->user);

        $user = $this->userService->getUserById(1);

        $this->assertSame($this->user, $user);
    }
}