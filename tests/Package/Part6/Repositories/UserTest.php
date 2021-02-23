<?php

declare(strict_types=1);

namespace Tests\Package\Part6\Repositories;

use App\Models;
use Package\Part6\Entities;
use Package\Part6\Repositories;
use Package\Part6\ValueObjects;
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
        $mail_address = 'jotaro@example.com';

        $user = new Entities\User(
            new ValueObjects\UserName($name),
            new ValueObjects\UserId($user_id),
            new ValueObjects\MailAddress($mail_address),
        );

        $this->repository->save($user);
        parent::seeInDatabase('users', [
            'user_id' => $user_id,
            'name' => $name,
            'mail_address' => $mail_address,
        ]);
    }

    /**
     * @test
     */
    public function findByUserId_レコードが存在する場合、entityが返るべき(): void
    {
        $user_id = 'z2020';
        fake(Models\User::class, [
            'user_id' => $user_id,
        ]);
        $actual = $this->repository->findByUserId(new ValueObjects\UserId($user_id));

        if ($actual instanceof Entities\User) {
            parent::assertSame($user_id, $actual->id->value);
        } else {
            parent::assertFalse(true, 'テストが落ちています');
        }
    }

    /**
     * @test
     */
    public function findByUserId_レコードが存在しない場合、nullが返るべき(): void
    {
        $user_id = new ValueObjects\UserId('z2020');
        $actual = $this->repository->findByUserId($user_id);

        parent::assertNull($actual);
    }

    /**
     * @test
     */
    public function findByUserName_レコードが存在する場合、entityが返るべき(): void
    {
        $name = '承太郎';
        fake(Models\User::class, [
            'name' => $name,
        ]);
        $actual = $this->repository->findByUserName(new ValueObjects\UserName($name));

        if ($actual instanceof Entities\User) {
            parent::assertSame($name, $actual->name->value);
        } else {
            parent::assertFalse(true, 'テストが落ちています');
        }
    }

    /**
     * @test
     */
    public function findByUserName_レコードが存在しない場合、nullが返るべき(): void
    {
        $name = new ValueObjects\UserName('ジャイロ');
        $actual = $this->repository->findByUserName($name);

        parent::assertNull($actual);
    }
}
