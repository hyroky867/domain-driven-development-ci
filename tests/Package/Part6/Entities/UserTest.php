<?php

declare(strict_types=1);

namespace Tests\Package\Part6\Entities;

use Package\Part6\Entities\User;
use Package\Part6\ValueObjects\UserName;
use Tests\PHPUnitTestCase;

final class UserTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function 値をセットできるべき(): void
    {
        $name = 'ジョルノ';
        $actual = new User(new UserName($name));
        parent::assertSame($name, $actual->name->value);
    }

    /**
     * @test
     */
    public function changeUserName(): void
    {
        $user = new User(new UserName('hoge'));

        $name = '承太郎';
        $user->changeUserName(new UserName($name));

        parent::assertSame($name, $user->name->value);
    }
}
