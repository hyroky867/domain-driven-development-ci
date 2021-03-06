<?php

declare(strict_types=1);

namespace Package\Part5\Entities;

interface EntityInterface
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

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
