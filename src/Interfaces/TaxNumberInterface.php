<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Interfaces;

interface TaxNumberInterface
{
    public function __construct(
        string $taxNumber = '',
        ?string $country = ''
    );

    public static function make(
        ?string $taxNumber = null,
        ?string $country = null
    );
}
