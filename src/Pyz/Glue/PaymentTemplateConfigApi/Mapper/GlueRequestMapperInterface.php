<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi\Mapper;

use Generated\Shared\Transfer\DisconnectParametersTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;

interface GlueRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function mapGlueRequestTransferToPaymentTemplateConfigTransfer(
        GlueRequestTransfer $glueRequestTransfer,
        PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
    ): PaymentTemplateConfigTransfer;

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     * @param \Generated\Shared\Transfer\DisconnectParametersTransfer $disconnectParametersTransfer
     *
     * @return \Generated\Shared\Transfer\DisconnectParametersTransfer
     */
    public function mapGlueRequestTransferToDisconnectParametersTransfer(
        GlueRequestTransfer $glueRequestTransfer,
        DisconnectParametersTransfer $disconnectParametersTransfer
    ): DisconnectParametersTransfer;
}
