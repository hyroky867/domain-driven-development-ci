<?php

declare(strict_types=1);

namespace Package\Part5\Repositories;

use Package\Part5\Entities;
use Package\Part5\ValueObjects;

interface UserInterface
{
    public function save(Entities\User $user): void;

    public function find(ValueObjects\UserName $id): ?Entities\User;
}
