<?php

declare(strict_types=1);

namespace Package\Part12\ValueObjects;

interface ValueObjectInterface
{
    /**
     * @return mixed
     * @param string $name
     */
    public function __get(string $name);

    /**
     * @param mixed $value
     * @param string $name
     */
    public function __set(string $name, $value): void;
}
