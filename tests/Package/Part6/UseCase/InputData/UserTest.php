<?php

declare(strict_types=1);

namespace Tests\Package\Part6\UseCase\InputData;

use Package\Part6\Entities;
use Package\Part6\UseCase;
use Package\Part6\ValueObjects;
use Tests\PHPUnitTestCase;

final class UserTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct_値がセットできるべき(): void
    {
        $name = 'ジョルノ・ジョバァーナ';
        $user_id = '2344329';
        $user = new Entities\User(
            new ValueObjects\UserName($name),
            new ValueObjects\UserId($user_id),
        );

        $actual = new UseCase\InputData\User($user);
        parent::assertSame($name, $actual->name);
        parent::assertSame($user_id, $actual->id);
    }
}
