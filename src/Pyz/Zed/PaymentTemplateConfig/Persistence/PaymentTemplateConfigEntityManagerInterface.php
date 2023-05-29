<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Persistence;

use Generated\Shared\Transfer\DisconnectParametersTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;

interface PaymentTemplateConfigEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function createConfig(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): PaymentTemplateConfigTransfer;

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function updateConfig(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): PaymentTemplateConfigTransfer;

    /**
     * @param \Generated\Shared\Transfer\DisconnectParametersTransfer $disconnectParametersTransfer
     *
     * @return void
     */
    public function deleteConfigByStoreReference(DisconnectParametersTransfer $disconnectParametersTransfer): void;
}
