<?php

declare(strict_types=1);

namespace Package\Part13\UseCase\Application\Services\Circle;

use Package\Part13\Collections;
use Package\Part13\Domains;
use Package\Part13\Entities;
use Package\Part13\Exceptions;
use Package\Part13\Factories;
use Package\Part13\Repositories;
use Package\Part13\Services;
use Package\Part13\UseCase;
use Package\Part13\ValueObjects;

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
        $id = new ValueObjects\Circle\CircleId($command->circle_id);
        $circle = $this->circle_repos->findByCircleId($id);

        if ($circle === null) {
            throw new Exceptions\Circle\NotFound('サークルが見つかりませんでした');
        }
        $members = $this->user_repos->getByIds($circle->members);

        $owner = $this->user_repos->findByUserId($circle->owner->id);

        if ($owner === null) {
            throw new Exceptions\User\NotFound();
        }

        $circle_members = new Collections\CircleMembers(
            $circle->circle_id,
            $owner,
            $members
        );

        $circle_full_specification = new Domains\Circle\FullSpecification($this->user_repos);

        if ($circle_full_specification->isSatisfiedBy($circle_members)) {
            throw new Exceptions\Circle\Full();
        }

        if ($members === []) {
            throw new Exceptions\User\NotFound('ユーザは見つかりませんでした');
        }

        $member_id = new ValueObjects\User\UserId($command->user_id);
        $member = $this->user_repos->findByUserId($member_id);

        if ($member === null) {
            throw new Exceptions\User\NotFound('ユーザは見つかりませんでした');
        }

        $add_member = [
            ...$circle->members,
            $member->id,
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
