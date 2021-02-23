<?php

declare(strict_types=1);

namespace Package\Part5\ValueObjects;

use Package\ReadOnlyTrait;

/**
 * @property-read string $value
 */
final class UserId
{
    use ReadOnlyTrait;

    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
