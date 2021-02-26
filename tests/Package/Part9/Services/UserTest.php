<?php

declare(strict_types=1);

namespace Tests\Package\Part9\Services;

use App\Models;
use Package\Part9\Entities;
use Package\Part9\Repositories;
use Package\Part9\Services;
use Package\Part9\ValueObjects;
use Tests\DBTestCase;

final class UserTest extends DBTestCase
{
    private Services\User $service;

    protected function setUp(): void
    {
        parent::setUp();
        parent::truncate('users');

        $this->service = new Services\User(new Repositories\User(new Models\User()));
    }

    /**
     * @test
     */
    public function exists_存在する場合、trueが返るべき(): void
    {
        $user = fake(\App\Models\User::class);
        $exists_user = new Entities\User(
            new ValueObjects\UserName($user->name),
            new ValueObjects\UserId($user->user_id),
        );

        $actual = $this->service->exists($exists_user);
        parent::assertTrue($actual);
    }

    /**
     * @test
     */
    public function exists_存在しない場合、falseが返るべき(): void
    {
        $user = new Entities\User(
            new ValueObjects\UserName('承太郎'),
            new ValueObjects\UserId('z2020'),
        );
        $actual = $this->service->exists($user);
        parent::assertFalse($actual);
    }
}
