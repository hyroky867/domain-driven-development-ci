<?php

declare(strict_types=1);

namespace Package;

use Exception;
use InvalidArgumentException;

trait ReadOnlyTrait
{
    public function __get(string $name)
    {
        if (!property_exists($this, $name)) {
            throw new InvalidArgumentException();
        }
        return $this->{$name};
    }

    public function __set(string $name, $value): void
    {
        throw new Exception();
    }
}
