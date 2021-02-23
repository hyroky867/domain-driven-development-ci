<?php

declare(strict_types=1);

namespace Tests\Package\Part5;

use App\Models;
use Package\Part5\Program;
use Package\Part5\Repositories;
use Tests\DBTestCase;

final class ProgramTest extends DBTestCase
{
    private Program $case;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->case = new Program(new Repositories\User(new Models\User()));
    }

    /**
     * @test
     */
    public function create_user_作成に成功した場合、値がDBに存在するべき(): void
    {
        $user_name = 'ジョニィ';
        $this->case->createUser($user_name);

        parent::seeInDatabase('users', [
            'name' => $user_name,
        ]);
    }
}
