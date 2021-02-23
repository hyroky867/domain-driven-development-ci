<?php

declare(strict_types=1);

namespace Package\Part5;

use Exception;

final class Program
{
    private Repositories\UserInterface $user_repos;

    public function __construct(Repositories\UserInterface $user_repos)
    {
        $this->user_repos = $user_repos;
    }

    public function createUser(string $user_name): void
    {
        $user_id = str_replace('.', '-', uniqid('', true));
        $user = new Entities\User(
            new ValueObjects\UserId($user_id),
            new ValueObjects\UserName($user_name)
        );

        $user_service = new Services\User($this->user_repos);

        if ($user_service->exists($user)) {
            throw new Exception("{$user_name} はすでに存在しています");
        }

        $this->user_repos->save($user);
    }
}
