<?php

declare(strict_types=1);

namespace Package\Part12\UseCase\InputData\Command\Circle;

use Package\ReadOnlyTrait;

/**
 * @property-read string $circle_id
 * @property-read string $name
 */
final class Update
{
    use ReadOnlyTrait;

    private string $circle_id;

    private string $name;

    public function __construct(
        string $circle_id,
        string $name
    ) {
        $this->circle_id = $circle_id;
        $this->name = $name;
    }
}
