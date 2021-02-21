<?php

declare(strict_types=1);

namespace Package\Part4\Entities;

use Package\Part4\ValueObjects\UserId;
use Package\Part4\ValueObjects\UserName;
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

    public function exists(self $user): bool
    {
        return $this->toArray() === $user->toArray();
    }
}
