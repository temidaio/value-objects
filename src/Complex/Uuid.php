<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Complex;

use Illuminate\Support\Str;
use Olsza\ValueObjects\Exceptions\InvalidUuidException;
use Olsza\ValueObjects\ValueObject;

class Uuid implements ValueObject
{
    /**
     * @var array
     */
    public array $uuids = [];

    /**
     * Create a new value object instance.
     *
     * @param string $uuid
     * @param string $name
     */
    final public function __construct(string $uuid, string $name)
    {
        $this->add($uuid, $name);
    }

    /**
     * Return a new instance of TaxNumber.
     *
     * @param string $uuid
     * @param string $name
     *
     * @return static
     */
    public static function make(
        string $uuid,
        string $name,
    ): static {
        return new static($uuid, $name);
    }

    /**
     * Add the UUID to the pool.
     *
     * @param string $uuid
     * @param string $name
     *
     * @return static
     * @throws \Exception
     */
    public function add(string $uuid, string $name): static
    {
        if (! Str::isUuid($uuid)) {
            throw new InvalidUuidException;
        }

        $this->uuids[$name] = $uuid;

        return $this;
    }

    /**
     * Get the first UUID from the pool.
     *
     * @return string|null
     */
    public function first(): ?string
    {
        return current($this->uuids) ?? null;
    }

    /**
     * Get the UUID from the pool by name.
     *
     * @param string $name
     *
     * @return string|null
     */
    public function getUuidFor(string $name): ?string
    {
        return $this->uuids[$name] ?? null;
    }

    /**
     * Return the first UUID if cast to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->first() ?? '';
    }
}
