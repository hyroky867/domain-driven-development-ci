<?php

declare(strict_types=1);

namespace Package\Part6\UseCase\Application\Services\User;

use Package\Part6\Entities;
use Package\Part6\Exceptions;
use Package\Part6\Repositories;
use Package\Part6\Services;
use Package\Part6\UseCase;
use Package\Part6\ValueObjects;

final class Register
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

    public function handle(UseCase\InputData\Command\User\Register $command): void
    {
        $user = new Entities\User(
            new ValueObjects\UserName($command->name),
        );

        if ($this->user_service->exists($user)) {
            throw new Exceptions\CanNotRegisterUser('ユーザはすでに存在しています。');
        }

        $this->user_repos->save($user);
    }
}
