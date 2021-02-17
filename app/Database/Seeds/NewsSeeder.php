<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'Elvis sighted',
                'slug' => 'elvis-sighted',
                // phpcs:ignore Generic.Files.LineLength.TooLong
                'body' => 'Elvis was sighted at the Podunk internet cafe. It looked like he was writing a CodeIgniter app.',
            ],
            [
                'title' => 'Say it isn\'t so!',
                'slug' => 'say-it-isnt-so',
                'body' => 'Scientists conclude that some programmers have a sense of humor.',
            ],
            [
                'title' => 'Caffeination, Yes!',
                'slug' => 'caffeination-yes',
                'body' => 'World\'s largest coffee shop open onsite nested coffee shop for staff only.',
            ],
        ];

        $this->db->table('news')->insertBatch($data);
    }
}
