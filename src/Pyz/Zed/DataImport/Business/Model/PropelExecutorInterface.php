<?php

/**
 * Copyright © 2022-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model;

interface PropelExecutorInterface
{
    /**
     * @param string $sql
     * @param array $parameters
     * @param bool $fetch
     *
     * @return array|null
     */
    public function execute(string $sql, array $parameters, bool $fetch = true): ?array;
}
