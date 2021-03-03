<?php

declare(strict_types=1);

namespace Package\Part11\UseCase\Application\Services\Circle;

use Package\Part11\Entities;
use Package\Part11\Exceptions;
use Package\Part11\Repositories;
use Package\Part11\Services;
use Package\Part11\UseCase;
use Package\Part11\ValueObjects;

/**
 * @property-read Repositories\CircleInterface $circle_repos
 * @property-read Repositories\CircleInvitationInterface $circle_invitation_repos
 * @property-read Services\Circle $circle_service
 * @property-read Repositories\UserInterface $user_repos
 */
final class Invite
{
    private Repositories\CircleInvitationInterface $circle_invitation_repos;
    private Repositories\CircleInterface $circle_repos;
    private Services\Circle $circle_service;
    private Repositories\UserInterface $user_repos;

    public function __construct(
        Repositories\CircleInterface $circle_repos,
        Repositories\CircleInvitationInterface $circle_invitation_repos,
        Services\Circle $circle_service,
        Repositories\UserInterface $user_repos
    ) {
        $this->circle_repos = $circle_repos;
        $this->circle_invitation_repos = $circle_invitation_repos;
        $this->circle_service = $circle_service;
        $this->user_repos = $user_repos;
    }

    public function handle(UseCase\InputData\Command\Circle\Invite $command): void
    {
        $from_user_id = new ValueObjects\User\UserId($command->from_user_id);
        $from_user = $this->user_repos->findByUserId($from_user_id);

        if ($from_user === null) {
            throw new Exceptions\User\NotFound('招待元ユーザは見つかりませんでした');
        }

        $invited_user_id = new ValueObjects\User\UserId($command->invited_user_id);
        $invited_user = $this->user_repos->findByUserId($invited_user_id);

        if ($invited_user === null) {
            throw new Exceptions\User\NotFound('招待先ユーザは見つかりませんでした');
        }

        $id = new ValueObjects\Circle\CircleId($command->circle_id);
        $circle = $this->circle_repos->findByCircleId($id);

        if ($circle === null) {
            throw new Exceptions\Circle\NotFound('サークルが見つかりませんでした');
        }

        if (count($circle->members) > 29) {
            throw new Exceptions\Circle\Full();
        }

        $circle_invitation = new Entities\CircleInvitation(
            $circle,
            $from_user,
            $invited_user
        );
        $this->circle_invitation_repos->save($circle_invitation);
    }
}
