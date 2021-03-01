<?php

declare(strict_types=1);

namespace Package\Part11\Factories;

use Package\Part11\Entities;
use Package\Part11\ValueObjects;

interface CircleInterface
{
    public function create(ValueObjects\Circle\Name $name, Entities\User $owner): Entities\Circle;
}
