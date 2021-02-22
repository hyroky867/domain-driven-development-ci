<?php

declare(strict_types=1);

namespace Package\Part4\Repositories;

use Package\Part4\Entities;
use Package\Part4\ValueObjects;

interface UserInterface
{
    public function firstByUserId(ValueObjects\UserId $id): ?Entities\User;
}
