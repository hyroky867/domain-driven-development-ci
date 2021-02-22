<?php

declare(strict_types=1);

namespace Package\Part4\Services;

use Package\Part4\Entities;
use Package\Part4\Repositories;

final class User
{
    /**
     * @var Repositories\User
     */
    private $user_repos;

    public function __construct(Repositories\User $user_repos = null)
    {
        $this->user_repos = $user_repos ?? new Repositories\User();
    }

    public function exists(Entities\User $user): bool
    {
        $result = $this->user_repos->firstByUserId($user->id);
        return $result instanceof Entities\User;
    }
}
