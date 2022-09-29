<?php

declare(strict_types=1);

namespace Temidaio\ValueObjects;

use Illuminate\Support\Str;
use MichaelRubel\ValueObjects\ValueObject;

class PostCode extends ValueObject
{
    /**
     * @var string|null
     */
    protected ?string $postcode = null;

    /**
     * @var City|null
     */
    protected ?City $city = null;

    /**
     * @var Country|null
     */
    protected ?Country $country = null;

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
     * @return string
     */
    public function value(): string
    {
        return $this->postcode ?? '';
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
        return $this->value();
    }
}
