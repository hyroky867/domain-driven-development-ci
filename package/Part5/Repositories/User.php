<?php

declare(strict_types=1);

namespace Package\Part5\Repositories;

use Package\Part5\Entities;
use Package\Part5\ValueObjects;

final class User implements UserInterface
{
    private \App\Models\User $model;

    public function __construct(\App\Models\User $model)
    {
        $this->model = $model;
    }

    public function save(Entities\User $user): void
    {
        $this->model->save([
            'user_id' => $user->id->value,
            'name' => $user->name->value,
        ]);
    }

    public function find(ValueObjects\UserName $name): ?Entities\User
    {
        $result = $this->model->where('name', $name->value)
            ->first();

        if ($result instanceof \App\Entities\User) {
            return new Entities\User(
                new ValueObjects\UserId($result->user_id),
                new ValueObjects\UserName($result->name)
            );
        }
        return null;
    }

    public function exists(Entities\User $user): bool
    {
        $result = $this->model->where('name', $user->name->value)
            ->first();
        return $result instanceof \App\Entities\User;
    }
}
