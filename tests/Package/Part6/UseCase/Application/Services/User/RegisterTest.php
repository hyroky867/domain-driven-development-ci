<?php

declare(strict_types=1);

namespace Tests\Package\Part6\UseCase\Application\Services\User;

use Package\Part6\Exceptions;
use Package\Part6\Repositories;
use Package\Part6\Services;
use Package\Part6\UseCase;
use Tests\DBTestCase;

final class RegisterTest extends DBTestCase
{
    private UseCase\Application\Services\User\Register $use_case;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->use_case = new UseCase\Application\Services\User\Register(
            new Repositories\User(new \App\Models\User()),
            new Services\User(new Repositories\User(new \App\Models\User()))
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
        $this->use_case->handle(new UseCase\InputData\Command\User\Register($name));
    }

    /**
     * @test
     */
    public function register_処理に成功した場合、値が保存されているべき(): void
    {
        $name = 'ジョナサン';
        $this->use_case->handle(new UseCase\InputData\Command\User\Register($name));

        parent::seeInDatabase('users', [
            'name' => $name,
        ]);
    }
}
