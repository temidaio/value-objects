<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Custom;

use Illuminate\Support\Str;
use Olsza\ValueObjects\Formatters\StreetFormatter;
use Olsza\ValueObjects\ValueObject;

class Street implements ValueObject
{
    /**
     * Internal properties.
     *
     * @var string|null
     */
    public ?string $prefix = null;
    public ?string $street = null;
    public ?string $number = null;
    public ?string $local  = null;

    /**
     * @param array|null $data
     */
    final public function __construct(?array $data)
    {
        collect($data)->each(
            fn ($value, $key) => ! property_exists($this, $key)
                ?: $this->{$key} = $this->sanitize($value)
        );
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
     * Sanitize the passed property.
     *
     * @param string|null $value
     *
     * @return string|null
     */
    protected function sanitize(?string $value): ?string
    {
        return ! is_null($value)
            ? Str::squish($value)
            : null;
    }

    /**
     * @return string
     */
    protected function format(): string
    {
        return format(StreetFormatter::class, [
            'prefix' => $this->prefix,
            'street' => $this->street,
            'number' => $this->number,
            'local'  => $this->local,
        ]);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->format();
    }
}
