<?php

declare(strict_types=1);

namespace Tests\Package\Part6\ValueObjects;

use InvalidArgumentException;
use Package\Part6\ValueObjects\UserId;
use Tests\PHPUnitTestCase;

final class UserIdTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct_空文字の場合、例外が返るべき(): void
    {
        parent::expectException(InvalidArgumentException::class);
        parent::expectExceptionMessage('valueが空文字です');
        new UserId('');
    }

    /**
     * @test
     */
    public function construct_空文字意外の場合、例外が返るべき(): void
    {
        $value = 'z2020';
        $actual = new UserId($value);
        parent::assertSame($value, $actual->value);
    }
}
