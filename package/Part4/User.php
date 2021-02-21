<?php

declare(strict_types=1);

namespace Package\Part4;

use Package\ReadOnlyTrait;

/**
 * @property-read UserId $id
 * @property-read UserName $name
 */
final class User
{
    use ReadOnlyTrait;

    private UserId $id;
    private UserName $name;

    public function __construct(UserId $id, UserName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
