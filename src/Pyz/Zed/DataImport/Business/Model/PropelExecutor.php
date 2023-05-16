<?php

/**
 * Copyright © 2022-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model;

use PDO;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Propel;

class PropelExecutor implements PropelExecutorInterface
{
    /**
     * @param string $sql
     * @param array $parameters
     * @param bool $fetch
     *
     * @return array|null
     */
    public function execute(string $sql, array $parameters, bool $fetch = true): ?array
    {
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($parameters);

        if (!$fetch) {
            return null;
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return \Propel\Runtime\Connection\ConnectionInterface
     */
    protected function getConnection(): ConnectionInterface
    {
        return Propel::getConnection();
    }
}
