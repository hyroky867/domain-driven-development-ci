<?php

declare(strict_types=1);

namespace Tests\Package\Part2;

use Package\Part2\ModelNumber;
use Tests\PHPUnitTestCase;

class ModelNumberTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function to_String(): void
    {
        $product_code = 'foo';
        $branch = 'bar';
        $lot = 'bee';
        $obj = new ModelNumber($product_code, $branch, $lot);

        $expected = "{$product_code}_{$branch}_{$lot}";
        parent::assertSame($expected, (string) $obj);
    }
}
