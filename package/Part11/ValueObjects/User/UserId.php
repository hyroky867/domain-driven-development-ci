<?php

declare(strict_types=1);

namespace Package\Part11\ValueObjects\User;

use InvalidArgumentException;
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
        if ($value === '') {
            throw new InvalidArgumentException('valueが空文字です');
        }
        $this->value = $value;
    }
}
