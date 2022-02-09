<?php

declare(strict_types=1);

namespace Olsza\ValueObjects;

class TaxNumber
{
    /**
     * Create a new TaxNumber instance.
     *
     * @param string $taxNumber
     * @param string|null $country
     */
    final public function __construct(
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
        return $this->taxNumber;
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
        $tempTaxNumber = strtoupper(trim($taxNumber));
        $tempTaxNumber = $this->preFilterTax($tempTaxNumber);
        $country = strtoupper($country);
        $tempCountry = substr($tempTaxNumber, 0, 2);
        $tempNumber = substr($tempTaxNumber, 2);

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
     * @param string|null $tempTaxNumber
     * @return string
     */
    private function preFilterTax(?string $tempTaxNumber): string
    {
        $tempTaxNumber = preg_replace('/[^\d\w]/', '', $tempTaxNumber);

        return (string)$tempTaxNumber;
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
