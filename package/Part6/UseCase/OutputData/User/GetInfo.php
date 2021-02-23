<?php

declare(strict_types=1);

namespace Package\Part6\UseCase\OutputData\User;

use Package\Part6\Entities;
use Package\ReadOnlyTrait;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $mail_address
 */
final class GetInfo
{
    use ReadOnlyTrait;

    private string $id;

    private string $name;

    private ?string $mail_address;

    public function __construct(Entities\User $source)
    {
        $this->id = $source->id->value;
        $this->name = $source->name->value;
        $this->mail_address = $source->mail_address->value;
    }
}
