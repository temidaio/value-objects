<?php

declare(strict_types=1);

namespace Temidaio\ValueObjects\Formatters;

use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;

class AddressFormatter implements Formatter
{
    /**
     * @param string|null $prefix
     * @param string|null $street
     * @param string|null $number
     * @param string|null $local
     * @param string|null $postcode
     * @param string|null $city
     * @param string|null $country
     * @param string|null $iso_code
     */
    public function __construct(
        public ?string $prefix   = null,
        public ?string $street   = null,
        public ?string $number   = null,
        public ?string $local    = null,
        public ?string $postcode = null,
        public ?string $city     = null,
        public ?string $country  = null,
        public ?string $iso_code = null
    ) {
    }

    /**
     * String builder.
     *
     * @var string
     */
    private string $builder = '';

    /**
     * Run the formatter.
     *
     * @return string
     */
    public function format(): string
    {
        $this->formatProperties();

        return $this->buildString();
    }

    /**
     * Initialize the internal properties.
     *
     * @return void
     */
    protected function formatProperties(): void
    {
        $this->street = format(
            StreetFormatter::class,
            prefix: $this->prefix,
            street: $this->street,
            number: $this->number,
            local: $this->local,
        );

        $this->country = format(
            CountryFormatter::class,
            country: $this->country,
            iso_code: $this->iso_code
        );
    }

    /**
     * Execute the formatter logic.
     *
     * @return string
     */
    protected function buildString(): string
    {
        if (! empty($this->street)) {
            $this->appendStreet();

            if (! empty($this->postcode) || ! empty($this->city) || ! empty($this->country)) {
                $this->appendComma();
            }
        }

        empty($this->postcode) ?: $this->appendPostcode();

        empty($this->city) ?: $this->appendCity();

        $this->appendCountry();

        return $this->builder();
    }

    /**
     * Sanitize the string builder.
     *
     * @return string
     */
    protected function builder(): string
    {
        return Str::squish($this->builder);
    }

    /**
     * Append the street to the string builder.
     *
     * @return void
     */
    protected function appendStreet(): void
    {
        $this->builder .= $this->street;
    }

    /**
     * Append the street to the string builder.
     *
     * @return void
     */
    protected function appendComma(): void
    {
        $this->builder .= ', ';
    }

    /**
     * Append the post code to the string builder.
     *
     * @return void
     */
    protected function appendPostcode(): void
    {
        $this->builder .= $this->postcode . ' ';
    }

    /**
     * Append the city to the string builder.
     *
     * @return void
     */
    protected function appendCity(): void
    {
        $this->builder .= $this->city . ' ';
    }

    /**
     * Append the country to the string builder.
     *
     * @return void
     */
    protected function appendCountry(): void
    {
        $this->builder .= $this->country;
    }
}
