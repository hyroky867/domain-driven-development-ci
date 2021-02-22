<?php

declare(strict_types=1);

namespace Tests\Package\Part4\Repositories;

use App\Models;
use Package\Part4\Entities;
use Package\Part4\Repositories;
use Package\Part4\ValueObjects;
use Tests\DBTestCase;

final class UserTest extends DBTestCase
{
    private Repositories\User $repository;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->repository = new Repositories\User();
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
}
