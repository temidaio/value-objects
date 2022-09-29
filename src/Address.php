<?php

declare(strict_types=1);

namespace Temidaio\ValueObjects;

use MichaelRubel\ValueObjects\ValueObject;
use Temidaio\ValueObjects\Formatters\AddressFormatter;

class Address extends ValueObject
{
    /**
     * @var Street
     */
    protected Street $street;

    /**
     * @var PostCode
     */
    protected PostCode $postcode;

    /**
     * @var City
     */
    protected City $city;

    /**
     * @var Country
     */
    protected Country $country;

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
     * @return string
     */
    public function value(): string
    {
        return $this->getFullAddress();
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
        return $this->value();
    }
}
