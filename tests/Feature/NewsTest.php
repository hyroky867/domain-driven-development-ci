<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Database\Seeds\NewsSeeder;
use CodeIgniter\Test\FeatureTestCase;

class NewsTest extends FeatureTestCase
{
    protected $refresh = false;

    /**
     * @var string
     */
    protected $namespace = 'App';

    /**
     * @var string
     */
    protected $seed = NewsSeeder::class;

    public function testGetNewsWithMock(): void
    {
        $result = $this->get('news');

        $result->assertStatus(200);
        $result->assertSee('<title>CodeIgniter Tutorial</title>');
    }
}
