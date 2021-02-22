<?php

declare(strict_types=1);

namespace Tests\Package\Part4;

use Package\Part4\Program;
use Tests\DBTestCase;

final class ProgramTest extends DBTestCase
{
    private Program $case;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->case = new Program();
    }

    /**
     * @test
     */
    public function create_user_作成に成功した場合、trueが返るべき(): void
    {
        $user_name = 'ジョニィ・ジョースター';
        $actual = $this->case->createUser($user_name);

        parent::assertTrue($actual);
        parent::hasInDatabase('users', [
            'name' => $user_name,
        ]);
    }
}
