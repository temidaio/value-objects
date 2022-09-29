<?php

declare(strict_types=1);

namespace Temidaio\ValueObjects;

use Illuminate\Support\Str;
use MichaelRubel\ValueObjects\ValueObject;
use Temidaio\ValueObjects\Formatters\StreetFormatter;

class Street extends ValueObject
{
    /**
     * Internal properties.
     *
     * @var string|null
     */
    protected ?string $prefix = null;
    protected ?string $street = null;
    protected ?string $number = null;
    protected ?string $local  = null;

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
     * @return string
     */
    public function value(): string
    {
        return $this->format();
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
        return $this->value();
    }
}
