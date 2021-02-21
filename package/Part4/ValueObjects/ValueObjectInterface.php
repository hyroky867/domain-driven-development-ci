<?php

declare(strict_types=1);

namespace Package\Part4\ValueObjects;

interface ValueObjectInterface
{
    /**
     * @return mixed
     */
    public function __get(string $name);

    /**
     * @param mixed $value
     */
    public function __set(string $name, $value): void;
}
