<?php

declare(strict_types=1);

namespace Package\Part13\Domains\Circle;

use Package\Part13\Collections;
use Package\Part13\Repositories;

final class FullSpecification
{
    private Repositories\UserInterface $user_repos;

    public function __construct(Repositories\UserInterface $user_repos)
    {
        $this->user_repos = $user_repos;
    }

    public function isSatisfiedBy(Collections\CircleMembers $members): bool
    {
        $premium_user_number = $members->countPremiumMembers(false);
        $circle_upper_limit = $premium_user_number < 10 ? 30 : 50;
        return $members->countMembers() >= $circle_upper_limit;
    }
}
