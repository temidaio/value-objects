<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Custom;

use Illuminate\Support\Str;
use Olsza\ValueObjects\ValueObject;

class PostCode implements ValueObject
{
    /**
     * @var string|null
     */
    public ?string $postcode = null;

    /**
     * @var City|null
     */
    public ?City $city = null;

    /**
     * @var Country|null
     */
    public ?Country $country = null;

    /**
     * @param array|null $data
     */
    final public function __construct(?array $data)
    {
        $this->postcode = $data['postcode'] ?? null;

        if (isset($data['city'])) {
            $this->city = new City($data);
        }

        if (isset($data['country_code'])) {
            $this->country = new Country($data);
        }

        if (! empty($this->postcode)) {
            $this->sanitize();
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
     * @return void
     */
    protected function sanitize(): void
    {
        if (! is_null($this->postcode)) {
            $this->postcode = Str::squish($this->postcode);
        }
    }

    /**
     * Cast the object to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->postcode ?? '';
    }
}
