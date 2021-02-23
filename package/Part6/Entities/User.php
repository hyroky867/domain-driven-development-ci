<?php

declare(strict_types=1);

namespace Package\Part6\Entities;

use Package\Part6\ValueObjects\MailAddress;
use Package\Part6\ValueObjects\UserId;
use Package\Part6\ValueObjects\UserName;
use Package\ReadOnlyTrait;

/**
 * @property-read UserId $id
 * @property-read UserName $name
 * @property-read MailAddress $mail_address
 */
final class User implements EntityInterface
{
    use ReadOnlyTrait;

    private UserId $id;
    private UserName $name;
    private MailAddress $mail_address;

    public function __construct(
        UserName $name,
        ?UserId $user_id = null,
        ?MailAddress $mail_address = null
    ) {
        $this->id = $user_id ?? new UserId(str_replace('.', '-', uniqid('', true)));
        $this->name = $name;
        $this->mail_address = $mail_address ?? new MailAddress(null);
    }

    public function fill(UserId $user_id, UserName $name): void
    {
        $this->id = $user_id;
        $this->name = $name;
    }

    public function changeUserName(UserName $name): void
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
