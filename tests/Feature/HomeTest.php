<?php

declare(strict_types=1);

namespace Tests\Feature;

use CodeIgniter\Test\FeatureTestCase;

class HomeTest extends FeatureTestCase
{
    public function testGetIndex(): void
    {
        $result = parent::get('/');

        $result->assertStatus(200);

        $result->assertSee('<title>Welcome to CodeIgniter 4!</title>');
        $result->assertSee('Environment: testing');
    }
}
