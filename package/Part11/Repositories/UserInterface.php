<?php

declare(strict_types=1);

namespace Package\Part11\Repositories;

use Package\Part11\Entities;
use Package\Part11\ValueObjects;

interface UserInterface
{
    public function findByUserId(ValueObjects\User\UserId $id): ?Entities\User;

    public function findByUserName(ValueObjects\User\Name $name): ?Entities\User;

    public function save(Entities\User $user): void;

    public function delete(Entities\User $user): void;
}
