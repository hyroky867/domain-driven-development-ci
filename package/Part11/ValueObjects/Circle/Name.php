<?php

declare(strict_types=1);

namespace Package\Part11\ValueObjects\Circle;

use InvalidArgumentException;
use Package\Part11\ValueObjects\ValueObjectInterface;
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
            throw new InvalidArgumentException('サークル名は3文字以上です');
        }

        if ($len > self::MAX_LEN) {
            throw new InvalidArgumentException('サークル名は20文字以下です');
        }
        $this->value = $value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
