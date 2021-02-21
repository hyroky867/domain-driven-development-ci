<?php

declare(strict_types=1);

namespace Tests\Package\Part4\Entities;

use Package\Part4\Entities\User;
use Package\Part4\ValueObjects\UserId;
use Package\Part4\ValueObjects\UserName;
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
    public function exists(): void
    {
        $check_id = new UserId('check');
        $check_name = new UserName('checker');
        $check_obj = new User($check_id, $check_name);

        $user_id = new UserId('id');
        $user_name = new UserName('承太郎');
        $user = new User($user_id, $user_name);

        $actual_true = $check_obj->exists($check_obj);
        parent::assertTrue($actual_true);

        $actual_false = $check_obj->exists($user);
        parent::assertFalse($actual_false);
    }
}
