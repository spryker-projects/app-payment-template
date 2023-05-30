<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfig;

class PaymentTemplateConfigMapper
{
    /**
     * @param \Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfig $spyPaymentTemplateConfig
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function mapPaymentTemplateConfigEntityToPaymentTemplateConfigTransfer(
        SpyPaymentTemplateConfig $spyPaymentTemplateConfig,
        PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
    ): PaymentTemplateConfigTransfer {
        return $paymentTemplateConfigTransfer->fromArray($spyPaymentTemplateConfig->toArray(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     * @param \Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfig $spyPaymentTemplateConfig
     *
     * @return \Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfig
     */
    public function mapPaymentTemplateConfigTransferToPaymentTemplateConfigEntity(
        PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer,
        SpyPaymentTemplateConfig $spyPaymentTemplateConfig
    ): SpyPaymentTemplateConfig {
        return $spyPaymentTemplateConfig->fromArray($paymentTemplateConfigTransfer->toArray());
    }
}
