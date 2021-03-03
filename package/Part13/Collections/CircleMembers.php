<?php

declare(strict_types=1);

namespace Package\Part13\Collections;

use Package\Part13\Entities;
use Package\Part13\ValueObjects;
use Package\ReadOnlyTrait;

/**
 * @property-read Entities\User $owner
 * @property-read Entities\User[] $members
 * @property-read ValueObjects\Circle\CircleId $circle_id
 */
class CircleMembers
{
    use ReadOnlyTrait;

    private ValueObjects\Circle\CircleId $circle_id;

    private Entities\User $owner;

    /**
     * @var Entities\User[]
     */
    private array $members;

    /**
     * @param ValueObjects\Circle\CircleId $circle_id
     * @param Entities\User $owner
     * @param Entities\User[] $members
     */
    public function __construct(
        ValueObjects\Circle\CircleId $circle_id,
        Entities\User $owner,
        array $members
    ) {
        $this->circle_id = $circle_id;
        $this->owner = $owner;
        $this->members = $members;
    }

    public function countMembers(): int
    {
        return count($this->members) + 1;
    }

    public function countPremiumMembers(bool $contains_owner = true): int
    {
        $premium_user_number = count(array_filter($this->members, fn (Entities\User $user) => $user->is_premium));

        if ($contains_owner === true) {
            return $premium_user_number + ($this->owner->is_premium ? 1 : 0);
        }
        return $premium_user_number;
    }
}
