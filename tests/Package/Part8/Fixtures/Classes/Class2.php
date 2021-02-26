<?php

declare(strict_types=1);

namespace Tests\Package\Part8\Fixtures\Classes;

use JsonSerializable;
use Tests\Package\Part8\Fixtures\Interfaces\Contract1;

final class Class2 implements JsonSerializable, Contract1
{
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function equals(self $other): bool
    {
        return json_encode($this) === json_encode($other);
    }
}
