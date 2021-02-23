<?php

declare(strict_types=1);

namespace Tests\Package\Part6\UseCase\InputData\Command\User;

use Package\Part6\UseCase;
use Tests\PHPUnitTestCase;

final class UpdateInfoTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function construct_値がセットできるべき(): void
    {
        $user_id = '2344329';
        $name = 'ジョルノ・ジョバァーナ';
        $mail_address = 'giogio@example.com';
        $actual = new UseCase\InputData\Command\User\UpdateInfo(
            $user_id,
            $name,
            $mail_address,
        );
        parent::assertSame($name, $actual->name);
        parent::assertSame($user_id, $actual->id);
        parent::assertSame($mail_address, $actual->mail_address);
    }
}
