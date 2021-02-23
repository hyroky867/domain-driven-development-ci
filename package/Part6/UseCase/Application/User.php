<?php

declare(strict_types=1);

namespace Package\Part6\UseCase\Application;

use Package\Part6\Entities;
use Package\Part6\Exceptions;
use Package\Part6\Repositories;
use Package\Part6\Services;
use Package\Part6\UseCase;
use Package\Part6\ValueObjects;

final class User
{
    private Repositories\UserInterface $user_repos;
    private Services\User $user_service;

    public function __construct(
        Repositories\UserInterface $user_repos,
        Services\User $user_service
    ) {
        $this->user_repos = $user_repos;
        $this->user_service = $user_service;
    }

    public function register(string $name): void
    {
        $user = new Entities\User(new ValueObjects\UserName($name));

        if ($this->user_service->exists($user)) {
            throw new Exceptions\CanNotRegisterUser('ユーザはすでに存在しています。');
        }

        $this->user_repos->save($user);
    }

    public function get(string $user_id): ?UseCase\InputData\User
    {
        $target_id = new ValueObjects\UserId($user_id);
        $user = $this->user_repos->findByUserId($target_id);

        if ($user instanceof Entities\User) {
            return new UseCase\InputData\User($user);
        }
        return null;
    }
}
