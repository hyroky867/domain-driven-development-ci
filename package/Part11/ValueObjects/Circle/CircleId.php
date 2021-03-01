<?php

declare(strict_types=1);

namespace Package\Part11\ValueObjects\Circle;

use Package\Part11\ValueObjects\ValueObjectInterface;
use Package\ReadOnlyTrait;

/**
 * @property-read string $value
 */
final class CircleId implements ValueObjectInterface
{
    use ReadOnlyTrait;

    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
