<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Complex;

use Illuminate\Support\Str;
use Olsza\ValueObjects\Formatters\NameFormatter;
use Olsza\ValueObjects\ValueObject;

class Name implements ValueObject
{
    /**
     * Create a new Uuid instance.
     *
     * @param string|null $first_name
     * @param string|null $last_name
     */
    final public function __construct(
        protected ?string $first_name = null,
        protected ?string $last_name = null
    ) {
        //
    }

    /**
     * Return a new instance of TaxNumber.
     *
     * @param string|null $first_name
     * @param string|null $last_name
     *
     * @return static
     */
    public static function make(
        ?string $first_name = null,
        ?string $last_name = null,
    ): static {
        return new static($first_name, $last_name);
    }

    /**
     * Get the first name.
     *
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return format(NameFormatter::class, $this->first_name);
    }

    /**
     * Get the last name.
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return format(NameFormatter::class, $this->last_name);
    }

    /**
     * Get the last name.
     *
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return Str::headline(
            $this->getFirstName() . $this->getLastName()
        );
    }

    /**
     * Return the first UUID if cast to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getFullName() ?? '';
    }
}
