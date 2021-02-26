<?php

declare(strict_types=1);

namespace Package\Part9\Repositories;

use Package\Part9\Entities;
use Package\Part9\ValueObjects;

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
            'mail_address' => $user->mail_address->value,
        ]);
    }

    public function findByUserId(ValueObjects\UserId $user_id): ?Entities\User
    {
        $result = $this->model->where('user_id', $user_id->value)
            ->first();

        if ($result instanceof \App\Entities\User) {
            return new Entities\User(
                new ValueObjects\UserName($result->name),
                new ValueObjects\UserId($result->user_id),
                new ValueObjects\MailAddress($result->mail_address)
            );
        }
        return null;
    }

    public function findByUserName(ValueObjects\UserName $name): ?Entities\User
    {
        $result = $this->model->where('name', $name->value)
            ->first();

        if ($result instanceof \App\Entities\User) {
            return new Entities\User(
                new ValueObjects\UserName($result->name),
                new ValueObjects\UserId($result->user_id),
                new ValueObjects\MailAddress($result->mail_address),
            );
        }
        return null;
    }

    public function delete(Entities\User $user): void
    {
        $this->model->where('user_id', $user->id->value)
            ->delete();
    }
}
