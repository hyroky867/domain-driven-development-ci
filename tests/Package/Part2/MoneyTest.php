<?php

declare(strict_types=1);

namespace Tests\Package\Part2;

use InvalidArgumentException;
use Package\Part2\Money;
use Tests\PHPUnitTestCase;

class MoneyTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function add_通貨が同じ場合、加算されるべき(): void
    {
        $my_money = new Money(1000, 'JPY');
        $allowance = new Money(3000, 'JPY');
        $actual = $my_money->add($allowance);

        $expected = 4000.0;
        parent::assertSame($expected, $actual->amount);
    }

    /**
     * @test
     */
    public function add_通貨が異なる場合、例外が返るべき(): void
    {
        $my_money = new Money(1000, 'JPY');
        $allowance = new Money(10, 'USD');

        parent::expectException(InvalidArgumentException::class);
        $expected = "通貨単位が異なります(this: {$my_money->currency}, arg: {$allowance->currency})";
        parent::expectExceptionMessage($expected);
        $my_money->add($allowance);
    }
}
