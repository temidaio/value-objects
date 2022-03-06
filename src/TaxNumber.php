<?php

declare(strict_types=1);

namespace Olsza\ValueObjects;

use Illuminate\Support\Str;
use Illuminate\Support\Traits\Conditionable;
use MichaelRubel\Formatters\Collection\TaxNumberFormatter;
use Olsza\ValueObjects\Interfaces\TaxNumberInterface;

class TaxNumber implements TaxNumberInterface
{
    use Conditionable;

    /**
     * Create a new TaxNumber instance.
     *
     * @param string $tax_number
     * @param string|null $country
     */
    public function __construct(
        private string $tax_number = '',
        private ?string $country = ''
    ) {
        $this->format();
        $this->transform();
    }

    /**
     * Return a new instance of TaxNumber.
     *
     * @param string|null $tax_number
     * @param string|null $country
     * @return static
     */
    public static function make(
        ?string $tax_number = null,
        ?string $country = null
    ): TaxNumber {
        return new static($tax_number, $country);
    }

    /**
     * Set the tax number for a given value object.
     *
     * @param string $tax_number
     *
     * @return void
     */
    public function setTaxNumber(string $tax_number): void
    {
        $this->tax_number = trim($tax_number);
    }

    /**
     * Set the country for a given value object.
     *
     * @param string $country
     * @return void
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * Get the tax number.
     *
     * @return string|null
     */
    public function getTaxNumber(): ?string
    {
        return Str::upper($this->tax_number);
    }

    /**
     * Get the country prefix.
     *
     * @return string
     */
    public function getCountry(): string
    {
        return Str::upper($this->country);
    }

    /**
     * Get a full tax number for a given value object.
     * The tax number with a country prefix.
     *
     * @return string
     */
    public function getFullTaxNumber(): string
    {
        return $this->getCountry() . $this->getTaxNumber();
    }

    /**
     * Transforms the data to appropriate form.
     *
     * @return void
     */
    private function transform(): void
    {
        $this->when($this->lengthIsLessOrEqualTwo(), function () {
            $this->country    = (string) Str::of($this->tax_number)
                ->substr(0, 2)
                ->upper();

            $this->tax_number = (string) Str::of($this->tax_number)
                ->substr(2);
        });
    }

    /**
     * Format the tax number.
     *
     * @return string
     */
    private function format(): string
    {
        return $this->tax_number = format(TaxNumberFormatter::class, [
            'country_iso' => $this->country,
            'tax_number'  => $this->tax_number,
        ]);
    }

    /**
     * Check if the tax number length is less or equal two.
     *
     * @return bool
     */
    private function lengthIsLessOrEqualTwo(): bool
    {
        return strlen($this->tax_number) >= 2;
    }

    /**
     * Get the raw string value.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getFullTaxNumber();
    }
}
