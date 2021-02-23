<?php

declare(strict_types=1);

namespace Package\Part5\Entities;

use Package\Part5\ValueObjects\UserId;
use Package\Part5\ValueObjects\UserName;
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

    public function __construct(UserId $id, UserName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return array<string, UserId|UserName>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function changeUserName(UserName $name): bool
    {
        if ($this->name->value !== $name->value) {
            $this->name = $name;
            return true;
        }
        return false;
    }
}
