<?php

declare(strict_types=1);

namespace Package\Part2;

use InvalidArgumentException;
use Package\ReadOnlyTrait;

/**
 * @property-read float $amount
 * @property-read string $currency
 */
final class Money
{
    use ReadOnlyTrait;

    private float $amount;
    private string $currency;

    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function add(self $arg): self
    {
        if ($this->currency !== $arg->currency) {
            $message = "通貨単位が異なります(this: {$this->currency}, arg: {$arg->currency})";
            throw new InvalidArgumentException($message);
        }
        return new self($this->amount + $arg->amount, $this->currency);
    }
}
