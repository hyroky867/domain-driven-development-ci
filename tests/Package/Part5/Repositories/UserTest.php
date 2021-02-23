<?php

declare(strict_types=1);

namespace Tests\Package\Part5\Repositories;

use App\Models;
use Package\Part5\Entities;
use Package\Part5\Repositories;
use Package\Part5\ValueObjects;
use Tests\DBTestCase;

final class UserTest extends DBTestCase
{
    private Repositories\User $repository;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->repository = new Repositories\User(new Models\User());
    }

    /**
     * @test
     */
    public function save(): void
    {
        $user_id = 'hogehoge';
        $name = '承太郎';

        $user = new Entities\User(
            new ValueObjects\UserId($user_id),
            new ValueObjects\UserName($name)
        );

        $this->repository->save($user);
        parent::seeInDatabase('users', [
            'user_id' => $user_id,
            'name' => $name,
        ]);
    }

    /**
     * @test
     */
    public function find_レコードが存在する場合、entityが返るべき(): void
    {
        $name = '承太郎';
        fake(Models\User::class, [
            'name' => $name,
        ]);
        $actual = $this->repository->find(new ValueObjects\UserName($name));

        if ($actual instanceof Entities\User) {
            parent::assertSame($name, $actual->name->value);
        } else {
            parent::assertFalse(false, 'テストが落ちています');
        }
    }

    /**
     * @test
     */
    public function find_レコードが存在しない場合、nullが返るべき(): void
    {
        $name = new ValueObjects\UserName('ジャイロ');
        $actual = $this->repository->find($name);

        parent::assertNull($actual);
    }

    /**
     * @test
     */
    public function exists_レコードが存在する場合、trueが返るべき(): void
    {
        $name = '承太郎';
        fake(Models\User::class, [
            'name' => $name,
        ]);
        $actual = $this->repository->find(new ValueObjects\UserName($name));

        if ($actual instanceof Entities\User) {
            parent::assertSame($name, $actual->name->value);
        } else {
            parent::assertFalse(true, 'テストが落ちています');
        }
    }

    /**
     * @test
     */
    public function exists_レコードが存在しない場合、falseが返るべき(): void
    {
        $name = new ValueObjects\UserName('ジャイロ・ツェペリ');
        $actual = $this->repository->find($name);

        parent::assertNull($actual);
    }
}
