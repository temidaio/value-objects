<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Custom;

use Olsza\ValueObjects\Formatters\AddressFormatter;
use Olsza\ValueObjects\ValueObject;

class Address implements ValueObject
{
    /**
     * @var Street
     */
    public Street $street;

    /**
     * @var PostCode
     */
    public PostCode $postcode;

    /**
     * @var City
     */
    public City $city;

    /**
     * @var Country
     */
    public Country $country;

    /**
     * @param array|null $data
     */
    final public function __construct(?array $data)
    {
        $this->country  = new Country($data);
        $this->street   = new Street($data);
        $this->city     = new City($data);
        $this->postcode = new PostCode($data);
    }

    /**
     * @param array|null $data
     *
     * @return static
     */
    public static function make(?array $data): static
    {
        return new static($data);
    }

    /**
     * @return string
     */
    public function getFullAddress(): string
    {
        return $this->format();
    }

    /**
     * @return string
     */
    protected function format(): string
    {
        return format(AddressFormatter::class, [
            'country'  => (string) $this->country,
            'street'   => (string) $this->street,
            'city'     => (string) $this->city,
            'postcode' => (string) $this->postcode,
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
