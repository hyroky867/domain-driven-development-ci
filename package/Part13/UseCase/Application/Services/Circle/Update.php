<?php

declare(strict_types=1);

namespace Package\Part12\UseCase\Application\Services\Circle;

use Package\Part12\Exceptions;
use Package\Part12\Repositories;
use Package\Part12\Services;
use Package\Part12\UseCase;
use Package\Part12\ValueObjects;

final class Update
{
    private Repositories\CircleInterface $circle_repos;
    private Repositories\UserInterface $user_repos;
    private Services\Circle $circle_service;

    public function __construct(
        Repositories\CircleInterface $circle_repos,
        Repositories\UserInterface $user_repos,
        Services\Circle $circle_service
    ) {
        $this->circle_repos = $circle_repos;
        $this->user_repos = $user_repos;
        $this->circle_service = $circle_service;
    }

    public function handle(UseCase\InputData\Command\Circle\Update $command): void
    {
        $circle_id = new ValueObjects\Circle\CircleId($command->circle_id);
        $circle = $this->circle_repos->findByCircleId($circle_id);

        if ($circle === null) {
            throw new Exceptions\User\NotFound();
        }

        $name = new ValueObjects\Circle\Name($command->name);
        $circle->changeName($name);

        if ($this->circle_service->exists($circle)) {
            throw new Exceptions\Circle\CanNotRegister();
        }
        $this->circle_repos->save($circle);
    }
}
