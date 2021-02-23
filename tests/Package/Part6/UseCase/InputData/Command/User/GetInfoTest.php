<?php

declare(strict_types=1);

namespace Tests\Package\Part6\UseCase\InputData\Command\User;

use Package\Part6\UseCase;
use Tests\PHPUnitTestCase;

final class GetInfoTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct_値がセットできるべき(): void
    {
        $user_id = '2344329';
        $actual = new UseCase\InputData\Command\User\GetInfo($user_id);

        parent::assertSame($user_id, $actual->user_id);
    }
}
