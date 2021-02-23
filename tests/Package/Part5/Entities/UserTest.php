<?php

declare(strict_types=1);

namespace Tests\Package\Part5\Entities;

use Package\Part5\Entities\User;
use Package\Part5\ValueObjects\UserId;
use Package\Part5\ValueObjects\UserName;
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

    /**
     * @test
     */
    public function changeUserName(): void
    {
        $id = new UserId('id');
        $name = new UserName('承太郎');
        $user = new User($id, $name);

        $actual_true = $user->changeUserName(new UserName('hoge'));
        parent::assertTrue($actual_true);

        $name = new UserName('承太郎');
        $user = new User($id, $name);

        $actual_false = $user->changeUserName($name);
        parent::assertFalse($actual_false);
    }
}
