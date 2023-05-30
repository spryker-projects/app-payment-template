<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Business\Saver;

use Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;

interface ConfigSaverInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer
     */
    public function saveConfig(
        PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
    ): PaymentTemplateConfigResponseTransfer;
}
