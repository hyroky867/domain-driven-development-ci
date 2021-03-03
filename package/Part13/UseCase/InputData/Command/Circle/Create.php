<?php

declare(strict_types=1);

namespace Package\Part12\UseCase\InputData\Command\Circle;

use Package\ReadOnlyTrait;

/**
 * @property-read string $user_id
 * @property-read string $name
 */
final class Create
{
    use ReadOnlyTrait;

    private string $user_id;

    private string $name;

    public function __construct(
        string $user_id,
        string $name
    ) {
        $this->user_id = $user_id;
        $this->name = $name;
    }
}
