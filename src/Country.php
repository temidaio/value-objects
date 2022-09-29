<?php

declare(strict_types = 1);

namespace Temidaio\ValueObjects;

use Illuminate\Support\Str;
use MichaelRubel\ValueObjects\ValueObject;
use Temidaio\ValueObjects\Formatters\CountryFormatter;

class Country extends ValueObject
{
    /**
     * Internal properties.
     *
     * @var string|null
     */
    protected ?string $iso_code = null;
    protected ?string $country = null;

    /**
     * @param array|null $data
     */
    final public function __construct(?array $data)
    {
        $this->iso_code = $data['country_code'] ?? null;
        $this->country  = $data['country'] ?? null;

        if (! empty($this->country)) {
            $this->sanitizeIsoCode();
            $this->sanitizeCountry();
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->format();
    }

    /**
     * Sanitize the ISO Code input.
     *
     * @return void
     */
    protected function sanitizeIsoCode(): void
    {
        if (! is_null($this->iso_code)) {
            $this->iso_code = Str::squish($this->iso_code);
        }
    }

    /**
     * Sanitize the Country input.
     *
     * @return void
     */
    protected function sanitizeCountry(): void
    {
        if (! is_null($this->country)) {
            $this->country = Str::squish($this->country);
        }
    }

    /**
     * Format the input country data.
     *
     * @return string
     */
    protected function format(): string
    {
        return format(CountryFormatter::class, [
            'country_code' => $this->iso_code,
            'country'      => $this->country,
        ]);
    }

    /**
     * Cast the object to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
