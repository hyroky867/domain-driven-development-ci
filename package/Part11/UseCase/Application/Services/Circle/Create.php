<?php

declare(strict_types=1);

namespace Package\Part11\UseCase\Application\Services\Circle;

use Package\Part11\Exceptions;
use Package\Part11\Factories;
use Package\Part11\Repositories;
use Package\Part11\Services;
use Package\Part11\UseCase;
use Package\Part11\ValueObjects;

final class Create
{
    private Factories\CircleInterface $circle_factory;
    private Repositories\CircleInterface $circle_repos;
    private Services\Circle $circle_service;
    private Repositories\UserInterface $user_repos;

    public function __construct(
        Factories\CircleInterface $circle_factory,
        Services\Circle $circle_service,
        Repositories\UserInterface $user_repos
    ) {
        $this->circle_factory = $circle_factory;
        $this->circle_service = $circle_service;
        $this->user_repos = $user_repos;
    }

    public function handle(UseCase\InputData\Command\Circle\Create $command): void
    {
        $owner_id = new ValueObjects\User\UserId($command->user_id);
        $owner = $this->user_repos->findByUserId($owner_id);

        if ($owner === null) {
            throw new Exceptions\User\NotFound(
                'サークルのオーナーとなるユーザが見つかりませんでした'
            );
        }

        $name = new ValueObjects\Circle\Name($command->name);
        $circle = $this->circle_factory->create($name, $owner);

        if ($this->circle_service->exists($circle)) {
            throw new Exceptions\Circle\CanNotRegister('サークルはすでに存在しています。');
        }

        $this->circle_repos->save($circle);
    }
}
