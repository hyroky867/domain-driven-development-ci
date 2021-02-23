<?php

declare(strict_types=1);

namespace Package\Part6\UseCase\Application\Services\User;

use Package\Part6\Exceptions;
use Package\Part6\Repositories;
use Package\Part6\Services;
use Package\Part6\UseCase;
use Package\Part6\ValueObjects;

final class UpdateInfo
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

    public function handle(UseCase\InputData\Command\User\UpdateInfo $command): void
    {
        $target_id = new ValueObjects\UserId($command->id);
        $user = $this->user_repos->findByUserId($target_id);

        if ($user === null) {
            throw new Exceptions\UserNotFound('IDに紐づくユーザが存在しません');
        }

        if (is_string($command->name)) {
            $new_user_name = new ValueObjects\UserName($command->name);
            $user->changeUserName($new_user_name);

            if ($this->user_service->exists($user)) {
                throw new Exceptions\CanNotRegisterUser('ユーザはすでに存在しています。');
            }
        }

        if (is_string($command->mail_address)) {
            $new_mail_address = new ValueObjects\MailAddress($command->mail_address);
            $user->changeMailAddress($new_mail_address);
        }
        $this->user_repos->save($user);
    }
}
