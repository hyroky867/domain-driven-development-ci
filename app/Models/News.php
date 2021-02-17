<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class News extends Model
{
    protected $table = 'news';

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'title',
        'slug',
        'body',
    ];

    /**
     * @return array<int, array>
     */
    public function getAll()
    {
        return parent::findAll();
    }

    /**
     * @param string $slug
     *
     * @return array<string, string>|null
     */
    public function firstBySlug(string $slug): ?array
    {
        $result = parent::asArray()
            ->where([
                'slug' => $slug,
            ])
            ->first();

        if (is_object($result)) {
            return (array) $result;
        }
        return $result;
    }
}
