<?php

declare(strict_types=1);

namespace Olsza\ValueObjects;

use MichaelRubel\Formatters\Collection\TaxNumberFormatter;
use Olsza\ValueObjects\Interfaces\TaxNumberInterface;

class TaxNumber implements TaxNumberInterface
{
    /**
     * Create a new TaxNumber instance.
     *
     * @param string $taxNumber
     * @param string|null $country
     */
    public function __construct(
        private string $taxNumber = '',
        private ?string $country = ''
    ) {
        $this->separationData($taxNumber, $country ?? '');
    }

    /**
     * Return a new instance of TaxNumber.
     *
     * @param string|null $taxNumber
     * @param string|null $country
     * @return static
     */
    public static function make(
        ?string $taxNumber = null,
        ?string $country = null
    ): TaxNumber {
        return new static($taxNumber, $country);
    }

    /**
     * Set the Tax Number for a given value object.
     *
     * @param string $taxNumber
     * @return void
     */
    public function setTaxNumber(string $taxNumber): void
    {
        $this->taxNumber = trim($taxNumber);
    }

    /**
     * Set the Country for a given value object.
     *
     * @param string $country
     * @return void
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * Get a Tax Number for a given value object.
     *
     * @return string|null
     */
    public function getTaxNumber(): ?string
    {
        return strtoupper($this->taxNumber);
    }

    /**
     * Get a Country for a given value object.
     *
     * @return string
     */
    public function getCountry(): string
    {
        return strtoupper($this->country);
    }

    /**
     * Get a Full Tax Number for a given value object. Tax Number with prefix Country
     *
     * @return string
     */
    public function getFullTaxNumber(): string
    {
        return $this->getCountry() . $this->getTaxNumber();
    }

    /**
     * Sets the appropriate data.
     *
     * @param string $taxNumber
     * @param string $country
     *
     * @return void
     */
    private function separationData(
        string $taxNumber = '',
        string $country = ''
    ): void {
        $tempTaxNumber = $this->preFilterTax($taxNumber, $country);
        $country = strtoupper($country);
        if (strlen($taxNumber) >= 2) {
            $tempCountry = substr($tempTaxNumber, 0, 2);
            $tempNumber = substr($tempTaxNumber, 2);
        } else {
            $tempNumber = substr($tempTaxNumber, strlen($country));
            $tempCountry = $country;
        }

        if (empty($country)) {
            $this->setCountry($tempCountry);
            $this->setTaxNumber($tempNumber);
        } else {
            $this->setCountry($country);

            if ($tempCountry == $country) {
                $this->setTaxNumber($tempNumber);
            } else {
                $this->setTaxNumber($tempTaxNumber);
            }
        }
    }

    /**
     * Filters data about Tax Number.
     *
     * @param string|null $taxNumber
     * @param string|null $country
     * @return string
     */
    private function preFilterTax(?string $taxNumber, ?string $country = null): string
    {
        return format(TaxNumberFormatter::class, [
            'country_iso' => $country,
            'tax_number' => $taxNumber,
        ]);
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
