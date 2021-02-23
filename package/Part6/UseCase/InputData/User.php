<?php

declare(strict_types=1);

namespace Package\Part6\UseCase\InputData;

use Package\Part6\Entities;
use Package\ReadOnlyTrait;

/**
 * @property-read string $id
 * @property-read string $name
 */
final class User
{
    use ReadOnlyTrait;

    private string $id;

    private string $name;

    public function __construct(Entities\User $source)
    {
        $this->id = $source->id->value;
        $this->name = $source->name->value;
    }
}
