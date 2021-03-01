<?php

declare(strict_types=1);

namespace Package\Part12\UseCase\InputData\Command\Circle;

use Package\ReadOnlyTrait;

/**
 * @property-read string $from_user_id
 * @property-read string $invited_user_id
 * @property-read string $circle_id
 */
final class Invite
{
    use ReadOnlyTrait;

    private string $from_user_id;

    private string $invited_user_id;

    private string $circle_id;

    public function __construct(
        string $from_user_id,
        string $invited_user_id,
        string $circle_id
    ) {
        $this->from_user_id = $from_user_id;
        $this->invited_user_id = $invited_user_id;
        $this->circle_id = $circle_id;
    }
}
