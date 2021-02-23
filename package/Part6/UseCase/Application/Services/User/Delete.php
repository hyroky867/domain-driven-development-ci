<?php

declare(strict_types=1);

namespace Package\Part6\UseCase\Application\Services\User;

use Package\Part6\Repositories;
use Package\Part6\UseCase;
use Package\Part6\ValueObjects;

final class Delete
{
    private Repositories\UserInterface $user_repos;

    public function __construct(Repositories\UserInterface $user_repos)
    {
        $this->user_repos = $user_repos;
    }

    public function handle(UseCase\InputData\Command\User\Delete $command): void
    {
        $user_id = new ValueObjects\UserId($command->user_id);
        $user = $this->user_repos->findByUserId($user_id);

        if ($user === null) {
            return;
        }
        $this->user_repos->delete($user);
    }
}
