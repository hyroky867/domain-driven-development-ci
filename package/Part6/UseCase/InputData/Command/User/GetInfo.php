<?php

declare(strict_types=1);

namespace Package\Part6\UseCase\InputData\Command\User;

use Package\ReadOnlyTrait;

/**
 * @property-read string $user_id
 */
final class GetInfo
{
    use ReadOnlyTrait;

    private string $user_id;

    public function __construct(string $user_id)
    {
        $this->user_id = $user_id;
    }
}
