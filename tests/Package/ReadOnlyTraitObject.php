<?php

declare(strict_types=1);

namespace Tests\Package;

use Package\ReadOnlyTrait;

/**
 * @property-read int $hoge
 * @property-read string $fuga
 */
final class ReadOnlyTraitObject
{
    use ReadOnlyTrait;

    private int $hoge;
    private string $fuga;

    public function __construct(int $hoge, string $fuga)
    {
        $this->hoge = $hoge;
        $this->fuga = $fuga;
    }
}
