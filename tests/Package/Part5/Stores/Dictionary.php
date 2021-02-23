<?php

declare(strict_types=1);

namespace Tests\Package\Part5\Stores;

use Package\Part5\Entities;
use Package\ReadOnlyTrait;

final class Dictionary
{
    use ReadOnlyTrait;

    /**
     * @var array<string, Entities\User>
     *
     * @TODO: php8でWeakmapを検討
     */
    public array $values = [];

    public function __construct(Entities\User $user = null)
    {
        if ($user instanceof Entities\User) {
            $this->set($user);
        }
    }

    public function set(Entities\User $user): void
    {
        $this->values[$user->id->value] = $user;
    }
}
