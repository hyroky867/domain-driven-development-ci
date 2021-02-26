<?php

declare(strict_types=1);

namespace Tests\Package\Part9\ValueObjects;

use InvalidArgumentException;
use Package\Part9\ValueObjects\MailAddress;
use Tests\PHPUnitTestCase;

final class MailAddressTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct_nullの場合、nullを入れるべき(): void
    {
        $actual = new MailAddress(null);
        parent::assertNull($actual->value);
    }

    /**
     * @test
     */
    public function construct_メールアドレスが長すぎる場合、例外が返るべき(): void
    {
        $max_length = MailAddress::MAX_LENGTH;
        parent::expectException(InvalidArgumentException::class);
        parent::expectExceptionMessage("メールアドレスは{$max_length}文字以下です");

        $domain = str_repeat('a', $max_length);
        $mail_address = "{$domain}@example.com";
        new MailAddress($mail_address);
    }

    /**
     * @test
     */
    public function construct_メールアドレスのフォーマットではない場合、例外が返るべき(): void
    {
        $mail_address = 'hoge/fuga';
        parent::expectException(InvalidArgumentException::class);
        parent::expectExceptionMessage('不正なフォーマットです');
        new MailAddress($mail_address);
    }

    /**
     * @test
     */
    public function construct_空文字意外の場合、例外が返るべき(): void
    {
        $mail_address = 'hoge@example.com';
        $actual = new MailAddress($mail_address);
        parent::assertSame($mail_address, $actual->value);
    }
}
