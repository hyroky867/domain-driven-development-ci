<?php

declare(strict_types=1);

namespace Package\Part13\ValueObjects\User;

use InvalidArgumentException;
use Package\Part13\ValueObjects\ValueObjectInterface;
use Package\ReadOnlyTrait;

/**
 * @property-read string $value
 */
final class Name implements ValueObjectInterface
{
    use ReadOnlyTrait;

    public const MIN_LEN = 3;
    public const MAX_LEN = 20;

    private string $value;

    public function __construct(string $value)
    {
        $len = mb_strlen($value);

        if ($len < self::MIN_LEN) {
            throw new InvalidArgumentException('ユーザ名は3文字以上です');
        }

        if ($len > self::MAX_LEN) {
            throw new InvalidArgumentException('ユーザ名は20文字以下です');
        }
        $this->value = $value;
    }
}
