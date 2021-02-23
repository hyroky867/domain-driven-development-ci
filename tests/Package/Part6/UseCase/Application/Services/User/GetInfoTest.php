<?php

declare(strict_types=1);

namespace Tests\Package\Part6\UseCase\Application\Services\User;

use Package\Part6\Repositories;
use Package\Part6\UseCase;
use Tests\DBTestCase;

final class GetInfoTest extends DBTestCase
{
    private UseCase\Application\Services\User\GetInfo $use_case;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->use_case = new UseCase\Application\Services\User\GetInfo(
            new Repositories\User(new \App\Models\User())
        );
    }

    /**
     * @test
     */
    public function handle_取得に成功した場合、ドメインモデルが返るべき(): void
    {
        $name = 'ジョセフ';
        $user_id = 'z9999';

        fake(\App\Models\User::class, [
            'name' => $name,
            'user_id' => $user_id,
        ]);

        $actual = $this->use_case->handle(
            new UseCase\InputData\Command\User\GetInfo($user_id)
        );

        if ($actual instanceof UseCase\OutputData\User\GetInfo) {
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

        $actual = $this->use_case->handle(
            new UseCase\InputData\Command\User\GetInfo($user_id)
        );
        parent::assertNull($actual);
    }
}
