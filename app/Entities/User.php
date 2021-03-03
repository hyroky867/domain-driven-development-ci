<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property-read int|null $id
 * @property-read string|null $user_id
 * @property-read string|null $name
 * @property-read string|null $mail_address
 * @property-read bool $is_premium
 */
final class User extends Entity
{
    private ?int $id;
    private ?string $user_id;
    private ?string $name;
    private ?string $mail_address;
    private bool $is_premium;

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
        $this->is_premium = $data['is_premium'] ?? false;
    }
}
