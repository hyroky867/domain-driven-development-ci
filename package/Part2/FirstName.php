<?php

declare(strict_types=1);

namespace Package\Part2;

/**
 * @property-read string $first_name
 * @property-read string $last_name
 */
final class FullName
{
    use ReadOnlyTrait;

    private string $first_name;
    private string $last_name;

    public function __construct(string $first_name, string $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function equal(self $other): bool
    {
        return $this->toArray() === $other->toArray();
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
