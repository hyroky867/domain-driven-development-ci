<?php

declare(strict_types=1);

namespace Tests\Package\Part6\UseCase\Application\Services\User;

use Package\Part6\Exceptions;
use Package\Part6\Repositories;
use Package\Part6\Services;
use Package\Part6\UseCase;
use Tests\DBTestCase;

final class UpdateInfoTest extends DBTestCase
{
    private UseCase\Application\Services\User\UpdateInfo $use_case;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->use_case = new UseCase\Application\Services\User\UpdateInfo(
            new Repositories\User(new \App\Models\User()),
            new Services\User(new Repositories\User(new \App\Models\User())),
        );
    }

    /**
     * @test
     */
    public function handle_idに紐づくユーザが存在しない場合、例外が返るべき(): void
    {
        $command = new UseCase\InputData\Command\User\UpdateInfo('j2020');
        parent::expectException(Exceptions\UserNotFound::class);
        parent::expectExceptionMessage('IDに紐づくユーザが存在しません');

        $this->use_case->handle($command);
    }

    /**
     * @test
     */
    public function handle_変更対象の名前がデータと同じ場合、例外が返るべき(): void
    {
        $user_id = 'j2020';
        $name = '東方定助';
        fake(\App\Models\User::class, [
            'user_id' => $user_id,
            'name' => $name,
        ]);
        $command = new UseCase\InputData\Command\User\UpdateInfo($user_id, $name);
        parent::expectException(Exceptions\CanNotRegisterUser::class);
        parent::expectExceptionMessage('ユーザはすでに存在しています');

        $this->use_case->handle($command);
    }

    /**
     * @test
     */
    public function handle_処理に成功した場合、値が保存されるべき(): void
    {
        $user_id = 'j1870';
        fake(\App\Models\User::class, [
            'user_id' => $user_id,
            'name' => 'ジョナサン・ジョースター',
            'mail_address' => 'jonathan@example.com',
        ]);
        $name = 'ジョナニィ・ジョースター';
        $mail_address = 'jonny@example.com';

        $command = new UseCase\InputData\Command\User\UpdateInfo($user_id, $name, $mail_address);
        $this->use_case->handle($command);

        parent::seeInDatabase('users', [
            'user_id' => $user_id,
            'name' => $name,
            'mail_address' => $mail_address,
        ]);
    }
}
