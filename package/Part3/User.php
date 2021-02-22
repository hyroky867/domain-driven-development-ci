<?php

declare(strict_types=1);

namespace Package\Part3;

use InvalidArgumentException;
use Package\ReadOnlyTrait;

/**
 * @property-read string $name
 */
final class User
{
    use ReadOnlyTrait;

    private string $name;

    public function __construct(string $name)
    {
        $this->changeName($name);
    }

    public function changeName(string $name): void
    {
        if (mb_strlen($name) < 3) {
            throw new InvalidArgumentException('ユーザ名は3文字以上です');
        }
        $this->name = $name;
    }
}
