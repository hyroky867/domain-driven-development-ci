<?php

declare(strict_types=1);

namespace Tests;

use CodeIgniter\Test\CIDatabaseTestCase;

class DBTestCase extends CIDatabaseTestCase
{
    /**
     * マイグレーションファイルは app 配下を見るように
     *
     * @var string
     */
    protected $namespace = 'App';

    protected function setUp(): void
    {
        parent::setUp();
        helper('test');
    }

    public function truncate(string $table): bool
    {
        $result = \Config\Database::connect()
            ->table($table)
            ->truncate();
        if ($result === true) {
            return true;
        }
        return false;
    }
}
