<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi\Mapper;

use Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;

class PaymentTemplateConfigMapper implements PaymentTemplateConfigMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer
     */
    public function mapPaymentTemplateConfigTransferToPaymentTemplateConfigCriteriaTransfer(
        PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer,
        PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
    ): PaymentTemplateConfigCriteriaTransfer {
        return $paymentTemplateConfigCriteriaTransfer->fromArray($paymentTemplateConfigTransfer->modifiedToArray(), true);
    }
}
