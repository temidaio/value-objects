<?php

declare(strict_types=1);

namespace Temidaio\ValueObjects\Formatters;

use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;

class CountryFormatter implements Formatter
{
    /**
     * @param string|null $country
     * @param string|null $iso_code
     */
    public function __construct(
        public ?string $country  = null,
        public ?string $iso_code = null
    ) {
    }

    /**
     * Run the formatter.
     *
     * @return string
     */
    public function format(): string
    {
        if (! empty($this->country)) {
            return Str::ucfirst($this->country);
        } elseif (! empty($this->iso_code)) {
            return Str::upper($this->iso_code);
        }

        return '';
    }
}
