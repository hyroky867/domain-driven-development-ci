<?php

declare(strict_types=1);

namespace Package\Part9\UseCase\InputData\Command\User;

use Package\ReadOnlyTrait;

/**
 * @property-read string $name
 */
final class Register
{
    use ReadOnlyTrait;

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
