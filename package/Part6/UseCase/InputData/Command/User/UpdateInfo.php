<?php

declare(strict_types=1);

namespace Package\Part6\UseCase\InputData\Command\User;

use Package\ReadOnlyTrait;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $mail_address
 */
final class UpdateInfo
{
    use ReadOnlyTrait;

    private string $id;

    private ?string $name;

    private ?string $mail_address;

    public function __construct(
        string $id,
        ?string $name = null,
        ?string $mail_address = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->mail_address = $mail_address;
    }
}
