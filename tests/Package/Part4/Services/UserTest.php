<?php

declare(strict_types=1);

namespace Tests\Package\Part4\Services;

use CodeIgniter\Test\CIDatabaseTestCase;
use Package\Part4\Entities;
use Package\Part4\Services;
use Package\Part4\ValueObjects;

final class UserTest extends CIDatabaseTestCase
{
    private Services\User $service;

    /**
     * @var string
     */
    protected $namespace = 'App';

    protected function setUp(): void
    {
        parent::setUp();
        helper('test');
        \Config\Database::connect()
            ->table('users')
            ->truncate();

        $this->service = new Services\User();
    }

    /**
     * @test
     */
    public function exists_存在する場合、trueが返るべき(): void
    {
        $user = fake(\App\Models\User::class);
        $exists_user = new Entities\User(
            new ValueObjects\UserId($user->user_id),
            new ValueObjects\UserName($user->name),
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
            new ValueObjects\UserId(''),
            new ValueObjects\UserName('承太郎')
        );
        $actual = $this->service->exists($user);
        parent::assertFalse($actual);
    }
}
