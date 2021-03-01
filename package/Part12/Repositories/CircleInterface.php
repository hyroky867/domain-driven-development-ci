<?php

declare(strict_types=1);

namespace Package\Part12\Repositories;

use Package\Part12\Entities;
use Package\Part12\ValueObjects;

interface CircleInterface
{
    public function save(Entities\Circle $circle): void;

    public function findByCircleId(ValueObjects\Circle\CircleId $id): ?Entities\Circle;

    public function findByCircleName(ValueObjects\Circle\Name $name): ?Entities\Circle;
}
