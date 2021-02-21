<?php

declare(strict_types=1);

namespace Package\Part2;

use Package\ReadOnlyTrait;

/**
 * @property-read string $product_code
 * @property-read string $branch
 * @property-read string $lot
 */
final class ModelNumber
{
    use ReadOnlyTrait;

    private string $product_code;
    private string $branch;
    private string $lot;

    public function __construct(
        string $product_code,
        string $branch,
        string $lot
    ) {
        $this->product_code = $product_code;
        $this->branch = $branch;
        $this->lot = $lot;
    }

    public function __toString(): string
    {
        return "{$this->product_code}_{$this->branch}_{$this->lot}";
    }
}
