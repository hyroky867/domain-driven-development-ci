<?php

declare(strict_types=1);

namespace Package\Part4;

use Exception;

final class Program
{
    private Services\User $service;

    public function __construct(Services\User $service = null)
    {
        $this->service = $service ?? new Services\User();
    }

    public function createUser(string $user_name): bool
    {
        $user_id = str_replace('.', '-', uniqid('', true));
        $user = new Entities\User(
            new ValueObjects\UserId($user_id),
            new ValueObjects\UserName($user_name)
        );

        if ($this->service->exists($user)) {
            throw new Exception("{$user_name} はすでに存在しています");
        }

        return $this->service->create($user);
    }
}
