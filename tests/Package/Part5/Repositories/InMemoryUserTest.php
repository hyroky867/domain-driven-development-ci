<?php

declare(strict_types=1);

namespace Tests\Package\Part5\Repositories;

use Package\Part5\Entities;
use Package\Part5\ValueObjects;
use Tests\Package\Part5\Repositories;
use Tests\Package\Part5\Stores;
use Tests\PHPUnitTestCase;

final class InMemoryUserTest extends PHPUnitTestCase
{
    private Repositories\InMemoryUser $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new Repositories\InMemoryUser();
    }

    /**
     * @test
     */
    public function find_ストアにデータが存在する場合、エンティティが返るべき(): void
    {
        $name = 'hoge';
        $user_name = new ValueObjects\UserName($name);
        $user = new Entities\User(
            new ValueObjects\UserId('999999'),
            $user_name
        );
        $this->repository->dictionary = new Stores\Dictionary($user);
        $actual = $this->repository->find($user_name);

        if ($actual instanceof Entities\User) {
            parent::assertSame($name, $actual->name->value);
        } else {
            parent::assertTrue(false, 'テストに落ちました。');
        }
    }

    /**
     * @test
     */
    public function find_ストアにデータがしない場合、nullが返るべき(): void
    {
        $user_name = new ValueObjects\UserName('hoge');

        $actual = $this->repository->find($user_name);
        parent::assertNull($actual);
    }

    /**
     * @test
     */
    public function save(): void
    {
        $user_id = '1234-56';
        $name = 'ジョセフ';
        $user = new Entities\User(
            new ValueObjects\UserId($user_id),
            new ValueObjects\UserName($name)
        );
        $this->repository->save($user);

        $actual = $this->repository->dictionary->values;
        parent::assertSame($name, $actual[$user_id]->name->value);
    }
}
