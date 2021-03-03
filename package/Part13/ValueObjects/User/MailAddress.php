<?php

declare(strict_types=1);

namespace Package\Part13\ValueObjects\User;

use InvalidArgumentException;
use Package\ReadOnlyTrait;

/**
 * @property-read string $value
 */
final class MailAddress
{
    use ReadOnlyTrait;

    public const MAX_LENGTH = 255;

    private ?string $value;

    public function __construct(?string $value)
    {
        if (is_string($value)) {
            $max_length = self::MAX_LENGTH;

            if (strlen($value) > $max_length) {
                throw new InvalidArgumentException("メールアドレスは{$max_length}文字以下です");
            }

            if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                throw new InvalidArgumentException('不正なフォーマットです');
            }
        }
        $this->value = $value;
    }
}
