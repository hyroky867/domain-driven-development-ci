<?php

declare(strict_types=1);

namespace Tests\Package\Part6\UseCase\OutputData\User;

use Package\Part6\Entities;
use Package\Part6\UseCase;
use Package\Part6\ValueObjects;
use Tests\PHPUnitTestCase;

final class GetInfoTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct_値がセットできるべき(): void
    {
        $user_id = 'z2020';
        $name = 'ジョルノ・ジョバァーナ';
        $user = new Entities\User(
            new ValueObjects\UserName($name),
            new ValueObjects\UserId($user_id),
        );
        $actual = new UseCase\OutputData\User\GetInfo($user);
        parent::assertSame($name, $actual->name);
        parent::assertSame($user_id, $actual->id);
        parent::assertNull($actual->mail_address);
    }
}
