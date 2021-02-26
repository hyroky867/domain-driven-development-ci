<?php

declare(strict_types=1);

namespace Package\Part9\Services;

use Package\Part9\Entities;
use Package\Part9\Repositories;

final class User
{
    private Repositories\UserInterface $user_repos;

    public function __construct(Repositories\UserInterface $user_repos)
    {
        $this->user_repos = $user_repos;
    }

    public function exists(Entities\User $user): bool
    {
        $result = $this->user_repos->findByUserName($user->name);
        return $result instanceof Entities\User;
    }
}
