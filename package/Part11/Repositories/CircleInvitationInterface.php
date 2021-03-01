<?php

declare(strict_types=1);

namespace Package\Part11\Repositories;

use Package\Part11\Entities;

interface CircleInvitationInterface
{
    public function save(Entities\CircleInvitation $entity): void;
}
