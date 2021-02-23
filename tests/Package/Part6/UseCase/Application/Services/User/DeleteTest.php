<?php

declare(strict_types=1);

namespace Tests\Package\Part6\UseCase\Application\Services\User;

use Package\Part6\Repositories;
use Package\Part6\UseCase;
use Tests\DBTestCase;

final class DeleteTest extends DBTestCase
{
    private UseCase\Application\Services\User\Delete $use_case;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->use_case = new UseCase\Application\Services\User\Delete(
            new Repositories\User(new \App\Models\User())
        );
    }

    /**
     * @test
     */
    public function handle_処理に成功した場合、値が削除保存されるべき(): void
    {
        $user_id = 'j1870';
        fake(\App\Models\User::class, [
            'user_id' => $user_id,
        ]);

        parent::seeInDatabase('users', [
            'user_id' => $user_id,
        ]);
        $this->use_case->handle(new UseCase\InputData\Command\User\Delete($user_id));

        parent::dontSeeInDatabase('users', [
            'user_id' => $user_id,
        ]);
    }

    /**
     * @test
     */
    public function handle_削除対象のデータが存在しない場合、値が削除保存されないべき(): void
    {
        $user_id = 'j1870';
        fake(\App\Models\User::class, [
            'user_id' => $user_id,
        ]);

        parent::seeInDatabase('users', [
            'user_id' => $user_id,
        ]);
        $this->use_case->handle(new UseCase\InputData\Command\User\Delete('hoge'));

        parent::seeInDatabase('users', [
            'user_id' => $user_id,
        ]);
    }
}
