<?php

declare(strict_types=1);

namespace Package\Part13\Factories;

use Package\Part13\Entities;
use Package\Part13\ValueObjects;

interface CircleInterface
{
    public function create(ValueObjects\Circle\Name $name, Entities\User $owner): Entities\Circle;
}
