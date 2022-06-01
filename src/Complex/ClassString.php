<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Complex;

use Olsza\ValueObjects\Exceptions\InvalidClassStringException;
use Olsza\ValueObjects\ValueObject;

class ClassString implements ValueObject
{
    /**
     * @var bool
     */
    private bool $classExists;

    /**
     * @var bool
     */
    private bool $interfaceExists;

    /**
     * Create a new value object instance.
     *
     * @param string|null $classString
     */
    final public function __construct(protected ?string $classString = null)
    {
        if (is_null($this->classString)) {
            return;
        }

        if (! str_contains($classString, '\\')) {
            throw new InvalidClassStringException;
        }

        $this->classExists     = class_exists($this->classString);
        $this->interfaceExists = interface_exists($this->classString);
    }

    /**
     * Return a new instance of TaxNumber.
     *
     * @param string|null $classString
     *
     * @return static
     */
    public static function make(?string $classString = null): static
    {
        return new static($classString);
    }

    /**
     * @return bool
     */
    public function isClassExists(): bool
    {
        return $this->classExists;
    }

    /**
     * @return bool
     */
    public function isInterfaceExists(): bool
    {
        return $this->interfaceExists;
    }

    /**
     * Get the last name.
     *
     * @return string|null
     */
    public function getClassString(): ?string
    {
        return $this->classString;
    }

    /**
     * Return the first UUID if cast to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getClassString() ?? '';
    }
}
