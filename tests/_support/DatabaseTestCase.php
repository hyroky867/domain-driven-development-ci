<?php

declare(strict_types=1);

namespace Tests\Support;

class DatabaseTestCase extends \CodeIgniter\Test\CIDatabaseTestCase
{
    protected $refresh = true;

    // @phpstan-ignore-next-line
    protected $seed = 'Tests\Support\Database\Seeds\ExampleSeeder';

    protected $basePath = SUPPORTPATH . 'Database/';

    // @phpstan-ignore-next-line
    protected $namespace = 'Tests\Support';

    public function setUp(): void
    {
        parent::setUp();

        // Extra code to run before each test
    }

    public function tearDown(): void
    {
        parent::tearDown();

        // Extra code to run after each test
    }
}
