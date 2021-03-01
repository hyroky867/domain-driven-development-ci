<?php

declare(strict_types=1);

namespace Package\Part11\Entities;

use Package\ReadOnlyTrait;

/**
 * @property-read Circle $circle
 * @property-read User $from_user
 * @property-read User $invited_user
 */
final class CircleInvitation implements EntityInterface
{
    use ReadOnlyTrait;

    private Circle $circle;
    private User $from_user;
    private User $invited_user;

    public function __construct(
        Circle $circle,
        User $from_user,
        User $invited_user
    ) {
        $this->circle = $circle;
        $this->from_user = $from_user;
        $this->invited_user = $invited_user;
    }
}
