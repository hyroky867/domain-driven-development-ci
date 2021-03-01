<?php

declare(strict_types=1);

namespace Package\Part12\Repositories;

use Package\Part12\Entities;
use Package\Part12\ValueObjects;

interface UserInterface
{
    public function findByUserId(ValueObjects\User\UserId $id): ?Entities\User;

    public function findByUserName(ValueObjects\User\Name $name): ?Entities\User;

    public function save(Entities\User $user): void;

    public function delete(Entities\User $user): void;
}
