<?php

declare(strict_types=1);

namespace Package\Part13\Repositories;

use Package\Part13\Entities;
use Package\Part13\ValueObjects;

interface UserInterface
{
    public function findByUserId(ValueObjects\User\UserId $id): ?Entities\User;

    public function findByUserName(ValueObjects\User\Name $name): ?Entities\User;

    public function save(Entities\User $user): void;

    public function delete(Entities\User $user): void;

    /**
     * @param ValueObjects\User\UserId[] $user_ids
     *
     * @return Entities\User[]
     */
    public function getByIds(array $user_ids): array;
}
