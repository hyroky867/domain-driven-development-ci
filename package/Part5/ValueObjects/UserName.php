<?php

declare(strict_types=1);

namespace Package\Part5\ValueObjects;

use InvalidArgumentException;
use Package\ReadOnlyTrait;

/**
 * @property-read string $value
 */
final class UserName implements ValueObjectInterface
{
    use ReadOnlyTrait;

    private string $value;

    public function __construct(string $value)
    {
        if (mb_strlen($value) < 3) {
            throw new InvalidArgumentException('ユーザ名は3文字以上です');
        }
        $this->value = $value;
    }
}
