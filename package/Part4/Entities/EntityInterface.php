<?php

declare(strict_types=1);

namespace Package\Part4\Entities;

interface EntityInterface
{
    /**
     * @return mixed
     */
    public function __get(string $name);

    /**
     * @param mixed $value
     */
    public function __set(string $name, $value): void;

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
