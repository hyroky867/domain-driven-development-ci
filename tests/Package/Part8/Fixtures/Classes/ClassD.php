<?php

declare(strict_types=1);

namespace Tests\Package\Part8\Fixtures\Classes;

use JsonSerializable;
use Tests\Package\Part8\Fixtures\Traits\GetsAndSets;

/**
 * @property-read ClassA $classA
 * @property-read int $x
 */
final class ClassD implements JsonSerializable
{
    use GetsAndSets;

    protected ClassA $classA;
    protected int $x;

    public function __construct(ClassA $classA, int $x)
    {
        $this->classA = $classA;
        $this->x = $x;
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
