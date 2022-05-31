<?php

declare(strict_types = 1);

namespace Olsza\ValueObjects\Custom;

use Illuminate\Support\Str;
use Olsza\ValueObjects\Formatters\CountryFormatter;
use Olsza\ValueObjects\ValueObject;

class Country implements ValueObject
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
     * Get the internal property.
     *
     * @param string $name
     *
     * @return string|null
     */
    public function __get(string $name): ?string
    {
        return $this->{$name};
    }

    /**
     * Set the internal property.
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, mixed $value): void
    {
        $this->{$name} = format(
            CountryFormatter::class,
            [$name => $value]
        );
    }

    /**
     * Cast the object to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->format();
    }
}
