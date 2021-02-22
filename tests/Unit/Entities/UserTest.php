<?php

declare(strict_types=1);

namespace Tests\Unit\Entities;

use App\Entities;
use Tests\PHPUnitTestCase;

final class UserTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function 値がセットされるべき(): void
    {
        $user_id = 'hoge';
        $name = 'fuga';

        $actual = new Entities\User([
            'user_id' => $user_id,
            'name' => $name,
        ]);

        $this->assertSame($user_id, $actual->user_id);
        $this->assertSame($name, $actual->name);
    }
}
