<?php

declare(strict_types=1);

namespace Package\Part6\UseCase\Application\Services\User;

use Package\Part6\Entities;
use Package\Part6\Repositories;
use Package\Part6\UseCase;
use Package\Part6\ValueObjects;

final class GetInfo
{
    private Repositories\UserInterface $user_repos;

    public function __construct(Repositories\UserInterface $user_repos)
    {
        $this->user_repos = $user_repos;
    }

    public function handle(
        UseCase\InputData\Command\User\GetInfo $command
    ): ?UseCase\OutputData\User\GetInfo {
        $target_id = new ValueObjects\UserId($command->user_id);
        $user = $this->user_repos->findByUserId($target_id);

        if ($user instanceof Entities\User) {
            return new UseCase\OutputData\User\GetInfo($user);
        }
        return null;
    }
}
