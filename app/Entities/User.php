<?php

declare(strict_types=1);

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property-read int $id
 * @property-read string $user_id
 * @property-read string $name
 */
final class User extends Entity
{
    private ?int $id;
    private ?string $user_id;
    private ?string $name;

    /**
     * @param array<string, mixed>|null $data
     */
    public function __construct(?array $data = null)
    {
        parent::__construct($data);

        $this->id = $data['id'] ?? null;
        $this->user_id = $data['user_id'] ?? null;
        $this->name = $data['name'] ?? null;
    }
}
