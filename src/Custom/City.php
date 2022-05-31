<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Custom;

use Illuminate\Support\Str;
use Olsza\ValueObjects\ValueObject;

class City implements ValueObject
{
    /**
     * @var string|null
     */
    public ?string $city = null;

    /**
     * @var Country|null
     */
    public ?Country $country = null;

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
     * Make the new Value Object.
     *
     * @param array|null $data
     *
     * @return static
     */
    public static function make(?array $data): static
    {
        return new static($data);
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
     * Cast the object to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->city ?? '';
    }
}
