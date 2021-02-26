<?php

declare(strict_types=1);

namespace Tests\Package\Part8\Fixtures\Traits;

use Tests\Package\Part8\Fixtures;

trait GetsAndSets
{
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            return $this->{$property} = $value;
        }

        return $this;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }
    }
}
