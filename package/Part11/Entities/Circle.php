<?php

declare(strict_types=1);

namespace Package\Part11\Entities;

use Package\Part11\ValueObjects;
use Package\ReadOnlyTrait;

/**
 * @property-read ValueObjects\Circle\CircleId $circle_id
 * @property-read ValueObjects\Circle\Name $name
 * @property-read User $owner
 * @property-read User[] $members
 */
final class Circle implements EntityInterface
{
    use ReadOnlyTrait;

    private ValueObjects\Circle\CircleId $id;
    private ValueObjects\Circle\Name $name;
    private User $owner;
    /**
     * @var User[]
     */
    private array $members;

    /**
     * @param ValueObjects\Circle\CircleId $circle_id
     * @param ValueObjects\Circle\Name $name
     * @param User $owner
     * @param User[] $members
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
}
