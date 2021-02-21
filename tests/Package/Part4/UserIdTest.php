<?php

declare(strict_types=1);

namespace Tests\Package\Part4;

use Package\Part4\UserId;
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
        parent::assertSame($value, $actual->value);
    }
}
