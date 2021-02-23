<?php

declare(strict_types=1);

namespace Package\Part6\Entities;

use Package\Part6\ValueObjects\UserId;
use Package\Part6\ValueObjects\UserName;
use Package\ReadOnlyTrait;

/**
 * @property-read UserId $id
 * @property-read UserName $name
 */
final class User implements EntityInterface
{
    use ReadOnlyTrait;

    private UserId $id;
    private UserName $name;

    public function __construct(UserName $name, ?UserId $user_id = null)
    {
        $this->id = $user_id ?? new UserId(str_replace('.', '-', uniqid('', true)));
        $this->name = $name;
    }

    public function fill(UserId $user_id, UserName $name): void
    {
        $this->id = $user_id;
        $this->name = $name;
    }

    public function changeUserName(UserName $name): void
    {
        if ($this->name->value !== $name->value) {
            $this->name = $name;
        }
    }
}
