<?php

declare(strict_types=1);

namespace Package\Part9\Factories;

use Package\Part9\Entities;
use Package\Part9\ValueObjects;

class User implements UserInterface
{
    public function create(ValueObjects\UserName $name): Entities\User
    {
        $user_id = str_replace('.', '-', uniqid('', true));
        return new Entities\User(
            $name,
            new ValueObjects\UserId($user_id),
        );
    }
}
