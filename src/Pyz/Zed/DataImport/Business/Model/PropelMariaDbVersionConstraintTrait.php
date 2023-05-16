<?php

/**
 * Copyright © 2022-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model;

/**
 * @deprecated Will be removed after MariaDB 10.4 support is dropped.
 */
trait PropelMariaDbVersionConstraintTrait
{
    /**
     * @param \Pyz\Zed\DataImport\Business\Model\PropelExecutorInterface $propelExecutor
     *
     * @throws \Pyz\Zed\DataImport\Business\Model\PropelMariaDbVersionConstraintException
     *
     * @return bool
     */
    protected function checkIsMariaDBSupportsBulkImport(PropelExecutorInterface $propelExecutor): bool
    {
        $version = $propelExecutor->execute('SELECT VERSION() AS version', []);

        $version = explode('-', current(current($version)));

        if ($version[1] !== 'MariaDB') {
            throw new PropelMariaDbVersionConstraintException(
                'Current database engine does not support bulk import.' .
                ' Bulk import is supported on MariaDB server version >= 10.5.',
            );
        }

        if (version_compare($version[0], '10.5') < 0) {
            throw new PropelMariaDbVersionConstraintException(
                'Current version of MariaDB does not support bulk import.' .
                ' Please update your MariaDB server to version >= 10.5.',
            );
        }

        return true;
    }
}
