<?php

declare(strict_types=1);

namespace Package\Part13\Repositories;

use Package\Part13\Entities;
use Package\Part13\ValueObjects;

interface CircleInterface
{
    public function save(Entities\Circle $circle): void;

    public function findByCircleId(ValueObjects\Circle\CircleId $id): ?Entities\Circle;

    public function findByCircleName(ValueObjects\Circle\Name $name): ?Entities\Circle;
}
