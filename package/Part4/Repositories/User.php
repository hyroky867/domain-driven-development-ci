<?php

declare(strict_types=1);

namespace Package\Part4\Repositories;

use Package\Part4\Entities;
use Package\Part4\ValueObjects;

final class User implements UserInterface
{
    private \App\Models\User $model;

    public function __construct(?\App\Models\User $model = null)
    {
        $this->model = $model ?? new \App\Models\User();
    }

    public function firstByUserId(ValueObjects\UserId $id): ?Entities\User
    {
        $result = $this->model->select([
            'user_id',
            'name'
        ])
            ->where('user_id', $id->value)
            ->first();
        if ($result instanceof \App\Entities\User) {
            return new Entities\User(
                new ValueObjects\UserId($result->user_id),
                new ValueObjects\UserName($result->name)
            );
        }
        return null;
    }
}
