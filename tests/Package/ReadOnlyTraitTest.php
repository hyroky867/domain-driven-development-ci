<?php

declare(strict_types=1);

namespace Tests\Package;

use Exception;
use InvalidArgumentException;
use Tests\PHPUnitTestCase;

final class ReadOnlyTraitTest extends PHPUnitTestCase
{
    /**
     * @var ReadOnlyTraitObject
     */
    private $readonly_obj;

    /**
     * @test
     */
    public function __get_プロパティに存在しない値を取得すると、例外が帰るべき(): void
    {
        parent::expectException(InvalidArgumentException::class);
        // @phpstan-ignore-next-line
        $this->readonly_obj->hogehoge;
    }

    /**
     * @test
     */
    public function __set_プロパティに値をセットすると、例外が帰るべき(): void
    {
        parent::expectException(Exception::class);
        // @phpstan-ignore-next-line
        $this->readonly_obj->hoge = 'hoge';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->readonly_obj = new ReadOnlyTraitObject(999999, 'hoge');
    }
}
