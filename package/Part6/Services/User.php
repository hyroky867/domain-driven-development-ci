<?php

declare(strict_types=1);

namespace Package\Part6\Services;

use Package\Part6\Entities;
use Package\Part6\Repositories;

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
