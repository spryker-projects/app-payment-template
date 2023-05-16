<?php

/**
 * Copyright © 2022-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model\Locale\Repository;

interface LocaleRepositoryInterface
{
    /**
     * @param string $locale
     *
     * @return int
     */
    public function getIdLocaleByLocale($locale);
}
