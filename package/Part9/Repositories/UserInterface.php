<?php

declare(strict_types=1);

namespace Package\Part9\Repositories;

use Package\Part9\Entities;
use Package\Part9\ValueObjects;

interface UserInterface
{
    public function findByUserId(ValueObjects\UserId $id): ?Entities\User;

    public function findByUserName(ValueObjects\UserName $name): ?Entities\User;

    public function save(Entities\User $user): void;

    public function delete(Entities\User $user): void;
}
