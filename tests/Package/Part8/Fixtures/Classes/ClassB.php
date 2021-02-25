<?php

declare(strict_types=1);

namespace Tests\Package\Part8\Fixtures\Classes;

use JsonSerializable;
use Tests\Package\Part8\Fixtures\Traits\GetsAndSets;

/**
 * @property-read ClassA $classA
 */
final class ClassB implements JsonSerializable
{
    use GetsAndSets;

    private ClassA $classA;

    public function __construct(ClassA $classA)
    {
        $this->classA = $classA;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function equals(self $other): bool
    {
        return json_encode($this) === json_encode($other);
    }
}
