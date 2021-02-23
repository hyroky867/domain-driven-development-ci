<?php

declare(strict_types=1);

namespace Tests\Package\Part6\ValueObjects;

use InvalidArgumentException;
use Package\Part6\ValueObjects\UserName;
use Tests\PHPUnitTestCase;

final class UserNameTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct_3文字未満の場合、例外が返るべき(): void
    {
        parent::expectException(InvalidArgumentException::class);
        parent::expectExceptionMessage('ユーザ名は3文字以上です');
        new UserName('仗助');
    }

    /**
     * @test
     */
    public function construct_20文字より多いの場合、例外が返るべき(): void
    {
        parent::expectException(InvalidArgumentException::class);
        parent::expectExceptionMessage('ユーザ名は20文字以下です');
        new UserName(str_repeat('a', 21));
    }

    /**
     * @test
     */
    public function construct_3文字以上の場合、値がセットされるべき(): void
    {
        $value = '承太郎';
        $actual = new UserName($value);
        parent::assertSame($value, $actual->value);
    }
}
