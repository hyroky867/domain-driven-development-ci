<?php

declare(strict_types=1);

namespace Package\Part9\UseCase\Application\Services\User;

use Package\Part9\Exceptions;
use Package\Part9\Factories;
use Package\Part9\Repositories;
use Package\Part9\Services;
use Package\Part9\UseCase;
use Package\Part9\ValueObjects;

final class Register
{
    private Repositories\UserInterface $user_repos;
    private Services\User $user_service;
    private Factories\UserInterface $user_factory;

    public function __construct(
        Repositories\UserInterface $user_repos,
        Services\User $user_service,
        Factories\UserInterface $user_factory
    ) {
        $this->user_repos = $user_repos;
        $this->user_service = $user_service;
        $this->user_factory = $user_factory;
    }

    public function handle(UseCase\InputData\Command\User\Register $command): void
    {
        $name = new ValueObjects\UserName($command->name);
        $user = $this->user_factory->create($name);

        if ($this->user_service->exists($user)) {
            throw new Exceptions\CanNotRegisterUser('ユーザはすでに存在しています。');
        }

        $this->user_repos->save($user);
    }
}
