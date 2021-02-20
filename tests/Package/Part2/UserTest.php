<?php

declare(strict_types=1);

namespace Tests\Package\Part2;

use Package\Part2\User;
use Package\Part2\UserId;
use Package\Part2\UserName;
use Tests\PHPUnitTestCase;

final class UserTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function 値をセットできるべき(): void
    {
        $actual = new User();

        $id = 'z2020';
        $actual->id = new UserId($id);

        $name = 'ジョルノ';
        $actual->name = new UserName($name);

        parent::assertTrue(true);
    }
}
