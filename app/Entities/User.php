<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property-read int $id
 * @property-read string $user_id
 * @property-read string $name
 * @property-read string|null $mail_address
 */
final class User extends Entity
{
    private ?int $id;
    private ?string $user_id;
    private ?string $name;
    private ?string $mail_address;

    /**
     * @param array<string, mixed>|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $this->id = $data['id'] ?? null;
        $this->user_id = $data['user_id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->mail_address = $data['mail_address'] ?? null;
    }
}
