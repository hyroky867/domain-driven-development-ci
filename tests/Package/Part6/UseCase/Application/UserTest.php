<?php

declare(strict_types=1);

namespace Tests\Package\Part6\UseCase\Application;

use Package\Part6\Exceptions;
use Package\Part6\Repositories;
use Package\Part6\Services;
use Package\Part6\UseCase;
use Tests\DBTestCase;

final class UserTest extends DBTestCase
{
    private UseCase\Application\User $use_case;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->use_case = new UseCase\Application\User(
            new Repositories\User(new \App\Models\User()),
            new Services\User(new Repositories\User(new \App\Models\User())),
        );
    }

    /**
     * @test
     */
    public function register_ユーザ名が重複した場合、例外を返すべき(): void
    {
        $name = 'ジョナサン';
        fake(\App\Models\User::class, [
            'name' => $name,
        ]);

        parent::expectException(Exceptions\CanNotRegisterUser::class);
        parent::expectExceptionMessage('ユーザはすでに存在しています。');
        $this->use_case->register($name);
    }

    /**
     * @test
     */
    public function register_処理に成功した場合、値が保存されているべき(): void
    {
        $name = 'ジョナサン';
        $this->use_case->register($name);

        parent::seeInDatabase('users', [
            'name' => $name,
        ]);
    }

    /**
     * @test
     */
    public function get_値が存在する場合、InputDataが返るべき(): void
    {
        $name = 'ジョセフ';
        $user_id = 'z9999';

        fake(\App\Models\User::class, [
            'name' => $name,
            'user_id' => $user_id,
        ]);

        $actual = $this->use_case->get($user_id);

        if ($actual instanceof UseCase\InputData\User) {
            parent::assertSame($name, $actual->name);
            parent::assertSame($user_id, $actual->id);
        } else {
            parent::assertTrue(false, 'テストが落ちています');
        }
    }

    /**
     * @test
     */
    public function get_値が存在しない場合、nullが返るべき(): void
    {
        $user_id = 'z9999';

        $actual = $this->use_case->get($user_id);
        parent::assertNull($actual);
    }
}
