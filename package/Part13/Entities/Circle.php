<?php

declare(strict_types=1);

namespace Package\Part13\Entities;

use Package\Part13\Exceptions;
use Package\Part13\ValueObjects;
use Package\ReadOnlyTrait;

/**
 * @property-read ValueObjects\Circle\CircleId $circle_id
 * @property-read ValueObjects\Circle\Name $name
 * @property-read User $owner
 * @property-read ValueObjects\User\UserId[] $members
 */
final class Circle implements EntityInterface
{
    use ReadOnlyTrait;

    public const MAX_MEMBER = 30;

    private ValueObjects\Circle\CircleId $id;
    private ValueObjects\Circle\Name $name;
    private User $owner;
    /**
     * @var ValueObjects\User\UserId[]
     */
    private array $members;

    /**
     * @param ValueObjects\Circle\CircleId $circle_id
     * @param ValueObjects\Circle\Name $name
     * @param User $owner
     * @param ValueObjects\User\UserId[] $members
     */
    public function __construct(
        ValueObjects\Circle\CircleId $circle_id,
        ValueObjects\Circle\Name $name,
        User $owner,
        array $members
    ) {
        $this->id = $circle_id;
        $this->name = $name;
        $this->owner = $owner;
        $this->members = $members;
    }

    public function isFull(): bool
    {
        return $this->countMembers() >= self::MAX_MEMBER;
    }

    public function join(User $user): void
    {
        if ($this->isFull()) {
            throw new Exceptions\Circle\Full();
        }

        $this->members[] = $user->id;
    }

    public function changeName(ValueObjects\Circle\Name $name): void
    {
        if ($this->name->value !== $name->value) {
            $this->name = $name;
        }
    }

    public function countMembers(): int
    {
        return count($this->members) + 1;
    }
}
