<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Business\Reader;

use Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;

interface ConfigReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer|null
     */
    public function findConfig(
        PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
    ): ?PaymentTemplateConfigTransfer;

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return bool
     */
    public function hasConfig(
        PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
    ): bool;
}
