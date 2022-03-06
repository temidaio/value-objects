<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Interfaces;

interface TaxNumberInterface
{
    /**
     * @param string $tax_number
     * @param string $country
     */
    public function __construct(string $tax_number = '', string $country = '');

    /**
     * @param string $tax_number
     * @param string $country
     *
     * @return mixed
     */
    public static function make(string $tax_number = '', string $country = ''): mixed;
}
