<?php

declare(strict_types=1);

namespace Package\Part13\Entities;

use Package\Part13\ValueObjects\User\MailAddress;
use Package\Part13\ValueObjects\User\Name;
use Package\Part13\ValueObjects\User\UserId;
use Package\ReadOnlyTrait;

/**
 * @property-read UserId $id
 * @property-read Name $name
 * @property-read MailAddress $mail_address
 * @property-read bool $is_premium
 */
final class User implements EntityInterface
{
    use ReadOnlyTrait;

    private UserId $id;
    private Name $name;
    private MailAddress $mail_address;
    private bool $is_premium;

    public function __construct(
        Name $name,
        ?UserId $user_id = null,
        ?MailAddress $mail_address = null,
        bool $is_premium = false
    ) {
        $this->id = $user_id ?? new UserId(str_replace('.', '-', uniqid('', true)));
        $this->name = $name;
        $this->mail_address = $mail_address ?? new MailAddress(null);
        $this->is_premium = $is_premium;
    }

    public function fill(UserId $user_id, Name $name): void
    {
        $this->id = $user_id;
        $this->name = $name;
    }

    public function changeName(Name $name): void
    {
        if ($this->name->value !== $name->value) {
            $this->name = $name;
        }
    }

    public function changeMailAddress(MailAddress $mail_address): void
    {
        if ($this->mail_address->value !== $mail_address->value) {
            $this->mail_address = $mail_address;
        }
    }
}
