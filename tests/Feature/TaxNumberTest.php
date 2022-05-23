<?php

namespace Olsza\ValueObjects\Tests\Feature;

use Olsza\ValueObjects\TaxNumber;
use Olsza\ValueObjects\Tests\TestCase;

class TaxNumberTest extends TestCase
{
    /** @test */
    public function testDataInTaxNumberIsNullAndCountryIsNull()
    {
        $data = new TaxNumber();
        $this->assertEmpty($data->getCountry());
        $this->assertEmpty($data->getTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberIsNumberPlusPrefixCountryIsNull()
    {
        $data = new TaxNumber('PL1234567890');
        $this->assertEquals('PL', $data->getCountry());
        $this->assertEquals('1234567890', $data->getTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberIsNumberPlusPrefixCountryIsNullAndPrefixLowercaseChar()
    {
        $data = new TaxNumber('pl1234567890');
        $this->assertEquals('PL', $data->getCountry());
        $this->assertEquals('1234567890', $data->getTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberIsNumberNotPrefixCountryIsNull()
    {
        $data = new TaxNumber('1234567890');
        $this->assertEquals('12', $data->getCountry());
        $this->assertEquals('34567890', $data->getTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberPlusPrefixCountryIsOk()
    {
        $data = new TaxNumber('PL1234567890', 'PL');
        $this->assertEquals('PL', $data->getCountry());
        $this->assertEquals('1234567890', $data->getTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberIsNumberCountryIsAdded()
    {
        $data = new TaxNumber('1234567890', 'pL');
        $this->assertEquals('PL', $data->getCountry());
        $this->assertEquals('1234567890', $data->getTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberIsNumberCountryIsAddedAnother()
    {
        $data = new TaxNumber('pL1234567890', 'aa');
        $this->assertEquals('AA', $data->getCountry());
        $this->assertEquals('PL1234567890', $data->getTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberIsNumberCountryIsAddedOutFullNumberVat()
    {
        $data = new TaxNumber('1234567890', 'pL');
        $this->assertEquals('PL1234567890', $data->getFullTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberIsNumberCountryIsAddedAndSpecialCharsOutFullNumberVat()
    {
        $data = new TaxNumber(' pl 123-456.78 90 ', 'pL');
        $this->assertEquals('PL1234567890', $data->getFullTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberIsNumberCountryIsAddedAnotherStatic()
    {
        $data = TaxNumber::make('pL006888nHy', 'aZ');
        $this->assertEquals('AZ', $data->getCountry());
        $this->assertEquals('PL006888NHY', $data->getTaxNumber());
    }

    /** @test */
    public function testDataInTaxNumberIsNumberCountryIsAddedAnotherMethodToString()
    {
        $this->assertEquals('AZPL123ABC456', TaxNumber::make('pL123aBc456', 'aZ'));
    }

    /** @test */
    public function testDataInTaxNumberIsNumberAndCountry()
    {
        $this->assertEquals('A6', TaxNumber::make('6', 'a'));
    }

    /** @test */
    public function testTestsThatAreUsedInExamplesInReadMe()
    {
        $this->assertEquals('PL0123456789', TaxNumber::make('pl0123456789'));
        $this->assertEquals('PL0123456789', TaxNumber::make('PL0123456789', 'pL'));
        $this->assertEquals('PL0123456789', TaxNumber::make('0123456789', 'pL'));
        $this->assertEquals('PLAB0123456789', TaxNumber::make('Ab0123456789', 'pL'));
        $this->assertEquals('PL0123456789', TaxNumber::make('PL 012-345 67.89'));

        $multi = TaxNumber::make('Ab 012-345 67.89', 'uK');
        $this->assertEquals('UKAB0123456789', $multi);
        $this->assertEquals('UKAB0123456789', $multi->getFullTaxNumber());
        $this->assertEquals('UK', $multi->getCountry());
        $this->assertEquals('AB0123456789', $multi->getTaxNumber());
    }

    /** @test */
    public function testPassedNullValueToVO()
    {
        $data = new TaxNumber(null, null);
        $this->assertEquals('', $data->getCountry());
        $this->assertEquals('', $data->getTaxNumber());

        $data = (new TaxNumber(null, null))
            ->getFullTaxNumber();
        $this->assertEquals('', $data);

        $data = TaxNumber::make(null, null);
        $this->assertEquals('', $data->getCountry());
        $this->assertEquals('', $data->getTaxNumber());

        $data = TaxNumber::make(null, null)
            ->getFullTaxNumber();
        $this->assertEquals('', $data);
    }

    /** @test */
    public function testPassedEmptyValuesToVO()
    {
        $data = new TaxNumber('', '');
        $this->assertEquals('', $data->getCountry());
        $this->assertEquals('', $data->getTaxNumber());

        $data = (new TaxNumber('', ''))
            ->getFullTaxNumber();
        $this->assertEquals('', $data);

        $data = TaxNumber::make('', '');
        $this->assertEquals('', $data->getCountry());
        $this->assertEquals('', $data->getTaxNumber());

        $data = TaxNumber::make('', '')
            ->getFullTaxNumber();
        $this->assertEquals('', $data);
    }

    /** @test */
    public function testPassedEmptyTaxNumberAndNullCountry()
    {
        $data = new TaxNumber('', null);
        $this->assertEquals('', $data->getCountry());
        $this->assertEquals('', $data->getTaxNumber());

        $data = (new TaxNumber('', null))
            ->getFullTaxNumber();
        $this->assertEquals('', $data);

        $data = TaxNumber::make('', null);
        $this->assertEquals('', $data->getCountry());
        $this->assertEquals('', $data->getTaxNumber());

        $data = TaxNumber::make('', null)
            ->getFullTaxNumber();
        $this->assertEquals('', $data);
    }

    /** @test */
    public function testPassedNullTaxNumberAndEmptyCountry()
    {
        $data = new TaxNumber(null, '');
        $this->assertEquals('', $data->getCountry());
        $this->assertEquals('', $data->getTaxNumber());

        $data = (new TaxNumber(null, ''))
            ->getFullTaxNumber();
        $this->assertEquals('', $data);

        $data = TaxNumber::make(null, '');
        $this->assertEquals('', $data->getCountry());
        $this->assertEquals('', $data->getTaxNumber());

        $data = TaxNumber::make(null, '')
            ->getFullTaxNumber();
        $this->assertEquals('', $data);
    }
}