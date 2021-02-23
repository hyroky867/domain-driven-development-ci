<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use Faker;

class User extends Model
{
    protected $table = 'users';

    protected $returnType = \App\Entities\User::class;

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'user_id',
        'name',
        'mail_address',
    ];

    /**
     * @param Faker\Generator $faker
     * @return array<string, string>
     */
    public function fake(Faker\Generator &$faker): array
    {
        return [
            'user_id' => $faker->uuid,
            'name' => "{$faker->firstName}_{$faker->lastName}",
            'mail_address' => $faker->safeEmail,
        ];
    }
}
