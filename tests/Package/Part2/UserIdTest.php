<?php

declare(strict_types=1);

namespace Tests\Package\Part2;

use Package\Part2\UserId;
use Tests\PHPUnitTestCase;

final class UserIdTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct(): void
    {
        $value = 'z2020';
        $actual = new UserId($value);
        $this->assertSame($value, $actual->value);
    }
}
