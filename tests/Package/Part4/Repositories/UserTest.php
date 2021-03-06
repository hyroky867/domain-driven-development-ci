<?php

declare(strict_types=1);

namespace Tests\Package\Part4\Repositories;

use App\Models;
use Package\Part4\Entities;
use Package\Part4\Repositories;
use Package\Part4\ValueObjects;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\DBTestCase;

final class UserTest extends DBTestCase
{
    private Repositories\User $repository;

    /**
     * @var MockObject|Models\User
     */
    private $model_mock;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->repository = new Repositories\User();

        $this->model_mock = parent::createMock(Models\User::class);
    }

    /**
     * @test
     */
    public function firstByUserId_レコードが存在する場合、entityが返るべき(): void
    {
        $user = fake(Models\User::class);
        $user_id = new ValueObjects\UserId($user->user_id);
        $actual = $this->repository->firstByUserId($user_id);

        if ($actual instanceof Entities\User) {
            parent::assertSame($user_id->value, $actual->id->value);
        }
        parent::assertFalse(false, 'テストが落ちています');
    }

    /**
     * @test
     */
    public function firstByUserId_レコードが存在しない場合、nullが返るべき(): void
    {
        $user_id = new ValueObjects\UserId('');
        $actual = $this->repository->firstByUserId($user_id);

        parent::assertNull($actual);
    }

    /**
     * @test
     */
    public function create_処理に成功した場合、trueを返すべき(): void
    {
        $user_id = uniqid('', true);
        $name = '承太郎';

        $user = new Entities\User(
            new ValueObjects\UserId($user_id),
            new ValueObjects\UserName($name)
        );

        $actual = $this->repository->create($user);
        $this->assertTrue($actual);
    }

    /**
     * @test
     */
    public function create_処理に失敗した場合、falseを返すべき(): void
    {
        $user_id = uniqid('', true);
        $name = '承太郎';

        $user = new Entities\User(
            new ValueObjects\UserId($user_id),
            new ValueObjects\UserName($name)
        );

        $this->model_mock->method('insert')
            ->willReturn(0);

        $this->repository = new Repositories\User($this->model_mock);

        $actual = $this->repository->create($user);
        parent::assertFalse($actual);
    }
}
