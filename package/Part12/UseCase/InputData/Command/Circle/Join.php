<?php

declare(strict_types=1);

namespace Package\Part12\UseCase\InputData\Command\Circle;

use Package\ReadOnlyTrait;

/**
 * @property-read string $user_id
 * @property-read string $circle_id
 */
final class Join
{
    use ReadOnlyTrait;

    private string $user_id;

    private string $circle_id;

    public function __construct(
        string $user_id,
        string $circle_id
    ) {
        $this->user_id = $user_id;
        $this->circle_id = $circle_id;
    }
}
