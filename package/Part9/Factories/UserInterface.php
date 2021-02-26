<?php

declare(strict_types=1);

namespace Package\Part9\Factories;

use Package\Part9\Entities;
use Package\Part9\ValueObjects;

interface UserInterface
{
    public function create(ValueObjects\UserName $name): Entities\User;
}
