<?php

declare(strict_types=1);

namespace Tests\Package\Part5\Repositories;

use Package\Part5\Entities;
use Package\Part5\Repositories;
use Package\Part5\ValueObjects;
use Tests\Package\Part5\Stores\Dictionary;

/**
 * @property-read array<ValueObjects\UserId, Entities\User> $values
 */
final class InMemoryUser implements Repositories\UserInterface
{
    public Dictionary $dictionary;

    public function __construct()
    {
        $this->dictionary = new Dictionary();
    }

    public function find(ValueObjects\UserName $name): ?Entities\User
    {
        if ($this->dictionary->values === []) {
            return null;
        }

        foreach ($this->dictionary->values as $item) {
            if ($item->name->value !== $name->value) {
                continue;
            }
            return $item;
        }
        return null;
    }

    public function save(Entities\User $user): void
    {
        $this->dictionary->values[$user->id->value] = $this->clone($user);
    }

    private function clone(Entities\User $user): Entities\User
    {
        return new Entities\User($user->id, $user->name);
    }
}
