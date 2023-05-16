<?php

/**
 * Copyright © 2022-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model\Locale\Repository;

use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;

class LocaleRepository implements LocaleRepositoryInterface
{
    /**
     * @var array
     */
    protected static $localeMap;

    /**
     * @param string $locale
     *
     * @return int
     */
    public function getIdLocaleByLocale($locale): int
    {
        if (!static::$localeMap) {
            $this->loadLocaleMap();
        }

        return static::$localeMap[$locale];
    }

    /**
     * @return void
     */
    private function loadLocaleMap()
    {
        /** @var array $localeCollection */
        $localeCollection = SpyLocaleQuery::create()
            ->select([SpyLocaleTableMap::COL_ID_LOCALE, SpyLocaleTableMap::COL_LOCALE_NAME])
            ->find();

        foreach ($localeCollection as $locale) {
            static::$localeMap[$locale[SpyLocaleTableMap::COL_LOCALE_NAME]] = $locale[SpyLocaleTableMap::COL_ID_LOCALE];
        }
    }
}
