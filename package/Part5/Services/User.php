<?php

declare(strict_types=1);

namespace Package\Part5\Services;

use Package\Part5\Entities;
use Package\Part5\Repositories;

final class User
{
    private Repositories\UserInterface $user_repos;

    public function __construct(Repositories\UserInterface $user_repos)
    {
        $this->user_repos = $user_repos;
    }

    public function exists(Entities\User $user): bool
    {
        return $this->user_repos->exists($user);
    }
}
