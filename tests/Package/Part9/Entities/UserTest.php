<?php

declare(strict_types=1);

namespace Tests\Package\Part9\Entities;

use Package\Part9\Entities;
use Package\Part9\ValueObjects;
use Tests\PHPUnitTestCase;

final class UserTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function 値をセットできるべき(): void
    {
        $name = 'ジョルノ';
        $user_id = 'z2020';
        $actual = new Entities\User(
            new ValueObjects\UserName($name),
            new ValueObjects\UserId($user_id),
        );
        parent::assertSame($name, $actual->name->value);
        parent::assertSame($user_id, $actual->id->value);
    }

    /**
     * @test
     */
    public function changeUserName(): void
    {
        $name = '承太郎';
        $user_id = 'z2121';
        $user = new Entities\User(
            new ValueObjects\UserName($name),
            new ValueObjects\UserId($user_id),
        );

        $user->changeUserName(new ValueObjects\UserName('hoge'));
        parent::assertNotSame($name, $user->name->value);

        $user->changeUserName(new ValueObjects\UserName($name));
        parent::assertSame($name, $user->name->value);
    }

    /**
     * @test
     */
    public function changeMailAddress(): void
    {
        $name = new ValueObjects\UserName('仗世文');
        $user_id = 'z2222';
        $mail_address = 'jojo@example.com';
        $user = new Entities\User(
            $name,
            new ValueObjects\UserId($user_id),
            new ValueObjects\MailAddress($mail_address)
        );

        $user->changeMailAddress(new ValueObjects\MailAddress('hoge@example.com'));
        parent::assertNotSame($mail_address, $user->mail_address->value);

        $user->changeMailAddress(new ValueObjects\MailAddress($mail_address));
        parent::assertSame($mail_address, $user->mail_address->value);
    }
}
