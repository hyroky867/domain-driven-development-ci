<?php

declare(strict_types=1);

namespace Package\Part9\ValueObjects;

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
        $len = mb_strlen($value);

        if ($len < 3) {
            throw new InvalidArgumentException('ユーザ名は3文字以上です');
        }

        if ($len > 20) {
            throw new InvalidArgumentException('ユーザ名は20文字以下です');
        }
        $this->value = $value;
    }
}
