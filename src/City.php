<?php

declare(strict_types=1);

namespace Temidaio\ValueObjects;

use Illuminate\Support\Str;
use MichaelRubel\ValueObjects\ValueObject;

class City extends ValueObject
{
    /**
     * @var string|null
     */
    protected ?string $city = null;

    /**
     * @var Country|null
     */
    protected ?Country $country = null;

    /**
     * @param array|null $data
     */
    final public function __construct(?array $data)
    {
        $this->city = $data['city'] ?? null;

        if (isset($data['country_code'])) {
            $this->country = new Country($data);
        }

        $this->sanitizeCity();
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->city ?? '';
    }

    /**
     * @return void
     */
    protected function sanitizeCity(): void
    {
        if (! is_null($this->city)) {
            $this->city = Str::squish($this->city);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
