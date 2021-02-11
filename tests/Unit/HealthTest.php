<?php

declare(strict_types=1);

namespace Tests\Unit;

class HealthTest extends \CodeIgniter\Test\CIUnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testIsDefinedAppPath(): void
    {
        $test = defined('APPPATH');

        $this->assertTrue($test);
    }

//    public function testBaseUrlHasBeenSet(): void
//    {
//        $env = false;
//
//        // First check in .env
//        if (is_file(HOMEPATH . '.env')) {
//            $env = (bool) preg_grep("/^app\\.baseURL = './", file(HOMEPATH . '.env'));
//        }
//
//        // Then check the actual config file
//        $reader = new \Tests\Support\Libraries\ConfigReader();
//        $config = !empty($reader->baseURL);
//
//        $this->assertTrue($env || $config);
//    }
}
