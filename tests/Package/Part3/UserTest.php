<?php

declare(strict_types=1);

namespace Tests\Package\Part3;

use Package\Part3\User;
use Tests\PHPUnitTestCase;

final class UserTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct_3文字未満の場合、例外が返るべき(): void
    {
        parent::expectException(\InvalidArgumentException::class);
        parent::expectExceptionMessage('ユーザ名は3文字以上です');
        new User('仗助');
    }

    /**
     * @test
     */
    public function construct_3文字以上の場合、値がセットされるべき(): void
    {
        $value = '承太郎';
        $actual = new User($value);
        parent::assertSame($value, $actual->name);
    }
}
