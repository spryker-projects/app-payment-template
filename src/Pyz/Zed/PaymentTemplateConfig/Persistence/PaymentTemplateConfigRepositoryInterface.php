<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Persistence;

use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;

interface PaymentTemplateConfigRepositoryInterface
{
    /**
     * @param string $storeReference
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer|null
     */
    public function findConfigByStoreReference(string $storeReference): ?PaymentTemplateConfigTransfer;
}
