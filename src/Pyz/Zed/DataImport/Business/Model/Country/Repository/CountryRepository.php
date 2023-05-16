<?php

/**
 * Copyright © 2022-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model\Country\Repository;

use ArrayObject;
use Orm\Zed\Country\Persistence\SpyCountryQuery;

class CountryRepository implements CountryRepositoryInterface
{
    /**
     * @var \ArrayObject
     */
    protected $countryIds;

    public function __construct()
    {
        $this->countryIds = new ArrayObject();
    }

    /**
     * @param string $countryName
     *
     * @return bool
     */
    public function hasCountryByName($countryName): bool
    {
        if ($this->countryIds->count() === 0) {
            $this->loadCountries();
        }

        return isset($this->countryIds[$countryName]);
    }

    /**
     * @param string $countryName
     *
     * @return int
     */
    public function getIdCountryByName($countryName): int
    {
        if ($this->countryIds->count() === 0) {
            $this->loadCountries();
        }

        return $this->countryIds[$countryName];
    }

    /**
     * @return void
     */
    private function loadCountries()
    {
        $query = SpyCountryQuery::create();

        foreach ($query->find() as $countryEntity) {
            $this->countryIds[$countryEntity->getName()] = $countryEntity->getIdCountry();
        }
    }
}
