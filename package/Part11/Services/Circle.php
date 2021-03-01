<?php

declare(strict_types=1);

namespace Package\Part11\Services;

use Package\Part11\Entities;
use Package\Part11\Repositories;

final class Circle
{
    private Repositories\CircleInterface $circle_repos;

    public function __construct(Repositories\CircleInterface $circle_repos)
    {
        $this->circle_repos = $circle_repos;
    }

    public function exists(Entities\Circle $circle): bool
    {
        $result = $this->circle_repos->findByCircleName($circle->name);
        return $result instanceof Entities\Circle;
    }
}
