<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new UserRepository(new User());
    }

    public function test_can_create_user()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => bcrypt('password')
        ];

        $user = $this->userRepository->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
    }

    public function test_can_update_user()
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Updated Test User',
            'email' => 'updated@test.com'
        ];

        $user = $this->userRepository->update($data,$user->id);

        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
    }

    public function test_can_delete_user()
    {
        $user = User::factory()->create();

        $this->userRepository->delete($user->id);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_can_find_user()
    {
        $user = User::factory()->create();

        $foundUser = $this->userRepository->find($user->id);

        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($foundUser->id, $user->id);
    }
}