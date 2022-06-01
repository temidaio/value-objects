<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Formatters;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;

class NameFormatter implements Formatter
{
    /**
     * @param string|null $name
     */
    public function __construct(public ?string $name)
    {
        //
    }

    /**
     * Format the date.
     *
     * @return string
     */
    public function format(): string
    {
        return (string) str($this->name)
            ->squish()
            ->headline();
    }
}
