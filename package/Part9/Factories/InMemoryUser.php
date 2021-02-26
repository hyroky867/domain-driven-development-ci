<?php

declare(strict_types=1);

namespace Package\Part9\Factories;

use Package\Part9\Entities;
use Package\Part9\ValueObjects;

class InMemoryUser implements UserInterface
{
    private int $current_id;

    public function create(ValueObjects\UserName $name): Entities\User
    {
        // ユーザが生成される度にインクリメントする
        $this->current_id++;
        return new Entities\User(
            $name,
            new ValueObjects\UserId((string) $this->current_id),
        );
    }
}
