<?php

declare(strict_types=1);

namespace Package\Part11\UseCase\Application\Services\Circle;

use Package\Part11\Entities;
use Package\Part11\Exceptions;
use Package\Part11\Factories;
use Package\Part11\Repositories;
use Package\Part11\Services;
use Package\Part11\UseCase;
use Package\Part11\ValueObjects;

final class Join
{
    private Factories\CircleInterface $circle_factory;
    private Repositories\CircleInterface $circle_repos;
    private Services\Circle $circle_service;
    private Repositories\UserInterface $user_repos;

    public function __construct(
        Factories\CircleInterface $circle_factory,
        Repositories\CircleInterface $circle_repos,
        Services\Circle $circle_service,
        Repositories\UserInterface $user_repos
    ) {
        $this->circle_factory = $circle_factory;
        $this->circle_repos = $circle_repos;
        $this->circle_service = $circle_service;
        $this->user_repos = $user_repos;
    }

    public function handle(UseCase\InputData\Command\Circle\Join $command): void
    {
        $member_id = new ValueObjects\User\UserId($command->user_id);
        $member = $this->user_repos->findByUserId($member_id);

        if ($member === null) {
            throw new Exceptions\User\NotFound('ユーザは見つかりませんでした');
        }

        $id = new ValueObjects\Circle\CircleId($command->circle_id);
        $circle = $this->circle_repos->findByCircleId($id);

        if ($circle === null) {
            throw new Exceptions\Circle\NotFound('サークルが見つかりませんでした');
        }

        if (count($circle->members) > 29) {
            throw new Exceptions\Circle\Full();
        }

        $add_member = [
            ...$circle->members,
            $member,
        ];
        $new_circle = new Entities\Circle(
            $circle->circle_id,
            $circle->name,
            $circle->owner,
            $add_member
        );
        $this->circle_repos->save($new_circle);
    }
}
