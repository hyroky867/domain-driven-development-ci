<?php

declare(strict_types=1);

namespace Tests\Package\Part4;

use Package\Part4\User;
use Package\Part4\UserId;
use Package\Part4\UserName;
use Tests\PHPUnitTestCase;

final class UserTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function 値をセットできるべき(): void
    {
        new User(new UserId('z2020'), new UserName('ジョルノ'));
        parent::assertTrue(true);
    }
}
