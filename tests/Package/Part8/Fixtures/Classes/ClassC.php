<?php

declare(strict_types=1);

namespace Tests\Package\Part8\Fixtures\Classes;

use JsonSerializable;
use Tests\Package\Part8\Fixtures\Traits\GetsAndSets;

/**
 * @property-read ClassA $classA
 * @property-read ClassB $classB
 */
final class ClassC implements JsonSerializable
{
    use GetsAndSets;

    private ClassA $classA;
    private ClassB $classB;

    public function __construct(ClassA $classA, ClassB $classB)
    {
        $this->classA = $classA;
        $this->classB = $classB;
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
