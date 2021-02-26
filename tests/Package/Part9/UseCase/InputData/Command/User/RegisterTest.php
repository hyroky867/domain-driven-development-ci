<?php

declare(strict_types=1);

namespace Tests\Package\Part9\UseCase\InputData\Command\User;

use Package\Part9\UseCase;
use Tests\PHPUnitTestCase;

final class RegisterTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct_値がセットできるべき(): void
    {
        $name = '吉良吉影';
        $actual = new UseCase\InputData\Command\User\Register($name);

        parent::assertSame($name, $actual->name);
    }
}
