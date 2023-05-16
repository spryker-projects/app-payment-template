<?php

/**
 * Copyright © 2022-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport;

use Spryker\Zed\DataImport\DataImportConfig as SprykerDataImportConfig;

/**
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
class DataImportConfig extends SprykerDataImportConfig
{
    /**
     * @var string
     */
    public const IMPORT_TYPE_GLOSSARY = 'glossary';

    /**
     * @var string
     */
    public const IMPORT_TYPE_CURRENCY = 'currency';

    /**
     * @var string
     */
    public const IMPORT_TYPE_STORE = 'store';

    /**
     * @return string|null
     */
    public function getDefaultYamlConfigPath(): ?string
    {
        return APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . 'data/import/local/full_GLOBAL.yml';
    }

    /**
     * @return array<string>
     */
    public function getFullImportTypes(): array
    {
        return [
            static::IMPORT_TYPE_STORE,
        ];
    }
}
