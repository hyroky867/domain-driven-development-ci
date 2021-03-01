<?php

declare(strict_types=1);

namespace Package\Part11\Repositories;

use Package\Part11\Entities;
use Package\Part11\ValueObjects;

interface CircleInterface
{
    public function save(Entities\Circle $circle): void;

    public function findByCircleId(ValueObjects\Circle\CircleId $id): ?Entities\Circle;

    public function findByCircleName(ValueObjects\Circle\Name $name): ?Entities\Circle;
}
