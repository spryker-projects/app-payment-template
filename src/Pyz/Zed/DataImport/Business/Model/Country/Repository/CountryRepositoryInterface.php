<?php

/**
 * Copyright © 2022-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model\Country\Repository;

interface CountryRepositoryInterface
{
    /**
     * @param string $countryName
     *
     * @return bool
     */
    public function hasCountryByName($countryName);

    /**
     * @param string $countryName
     *
     * @return int
     */
    public function getIdCountryByName($countryName);
}
