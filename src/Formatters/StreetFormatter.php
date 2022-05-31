<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Formatters;

use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;

class StreetFormatter implements Formatter
{
    /**
     * String builder.
     *
     * @var string
     */
    private string $builder = '';

    /**
     * @param string|null $prefix
     * @param string|null $street
     * @param string|null $number
     * @param string|null $local
     */
    public function __construct(
        public ?string $prefix = null,
        public ?string $street = null,
        public ?string $number = null,
        public ?string $local  = null
    ) {
    }

    /**
     * Execute the formatter logic.
     *
     * @return string
     */
    public function format(): string
    {
        if (! empty($this->prefix) && ! empty($this->street)) {
            $this->appendPrefix();
        }

        $this->appendStreet();

        if (! empty($this->local)) {
            if (! empty($this->number)) {
                $this->appendSlash();
            }

            $this->appendLocal();
        }

        return $this->builder();
    }

    /**
     * Sanitize the string builder.
     *
     * @return string
     */
    protected function builder(): string
    {
        return Str::squish($this->builder);
    }

    /**
     * Append the prefix to the string builder.
     *
     * @return void
     */
    protected function appendPrefix(): void
    {
        $this->builder .= $this->prefix . ' ';
    }

    /**
     * Append the street & number to the string builder.
     *
     * @return void
     */
    protected function appendStreet(): void
    {
        $this->builder .= $this->street . ' ' . $this->number;
    }

    /**
     * Append slash to the string builder.
     *
     * @return void
     */
    protected function appendSlash(): void
    {
        $this->builder .= '/';
    }

    /**
     * Append slash to the string builder.
     *
     * @return void
     */
    protected function appendLocal(): void
    {
        $this->builder .= $this->local;
    }
}
