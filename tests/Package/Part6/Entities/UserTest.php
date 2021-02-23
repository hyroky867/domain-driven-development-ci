<?php

declare(strict_types=1);

namespace Tests\Package\Part6\Entities;

use Package\Part6\Entities;
use Package\Part6\ValueObjects;
use Tests\PHPUnitTestCase;

final class UserTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function 値をセットできるべき(): void
    {
        $name = 'ジョルノ';
        $actual = new Entities\User(new ValueObjects\UserName($name));
        parent::assertSame($name, $actual->name->value);
    }

    /**
     * @test
     */
    public function fill(): void
    {
        $user = new Entities\User(new ValueObjects\UserName('hoge'));
        $user_id = 'z2020';
        $name = '承太郎';

        $user->fill(
            new ValueObjects\UserId($user_id),
            new ValueObjects\UserName($name)
        );

        parent::assertSame($user_id, $user->id->value);
        parent::assertSame($name, $user->name->value);
    }

    /**
     * @test
     */
    public function changeUserName(): void
    {
        $name = '承太郎';
        $user = new Entities\User(new ValueObjects\UserName($name));

        $user->changeUserName(new ValueObjects\UserName('hoge'));
        parent::assertNotSame($name, $user->name->value);

        $user->changeUserName(new ValueObjects\UserName($name));
        parent::assertSame($name, $user->name->value);
    }
}
