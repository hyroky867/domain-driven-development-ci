<?php

declare(strict_types=1);

namespace Tests\Package\Part2;

use Package\Part2\FullName;
use Tests\PHPUnitTestCase;

class FullNameTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function equal(): void
    {
        $first_name = '空条';
        $last_name = '承太郎';

        $obj_1 = new FullName($first_name, $last_name);
        $actual_success = $obj_1->equal(new FullName($first_name, $last_name));
        parent::assertTrue($actual_success);

        $actual_failed = $obj_1->equal(new FullName('空条', '仗世文'));
        parent::assertFalse($actual_failed);
    }

    /**
     * @test
     */
    public function toArray(): void
    {
        $first_name = '空条';
        $last_name = '承太郎';

        $obj = new FullName($first_name, $last_name);

        $actual = $obj->toArray();
        $expected = [
            'first_name' => $first_name,
            'last_name' => $last_name,
        ];
        parent::assertSame($expected, $actual);
    }
}
