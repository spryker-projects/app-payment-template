<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi\Controller;

use Generated\Shared\Transfer\DisconnectParametersTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \Pyz\Glue\PaymentTemplateConfigApi\PaymentTemplateConfigApiFactory getFactory()
 */
class PaymentTemplateConfigApiController extends AbstractController
{
    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function postSaveAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $glueRequestValidationTransfer = $this->getFactory()->createApiRequestSaveConfigValidator()
            ->validate($glueRequestTransfer);

        if (!$glueRequestValidationTransfer->getIsValid()) {
            return $this->getFactory()->createResponseBuilder()
                ->buildRequestNotValidResponse($glueRequestValidationTransfer);
        }

        $paymentTemplateConfigTransfer = $this->getFactory()->createGlueRequestMapper()
            ->mapGlueRequestTransferToPaymentTemplateConfigTransfer($glueRequestTransfer, new PaymentTemplateConfigTransfer());

        $paymentTemplateConfigResponseTransfer = $this->getFactory()->getPaymentTemplateConfigFacade()
            ->saveConfig($paymentTemplateConfigTransfer);

        if (!$paymentTemplateConfigResponseTransfer->getIsSuccessful()) {
            return $this->getFactory()->createResponseBuilder()
                ->buildCredentialsSaveErrorResponse($paymentTemplateConfigResponseTransfer);
        }

        $paymentTemplateConfigCriteriaTransfer = $this->getFactory()->createPaymentTemplateConfigMapper()
            ->mapPaymentTemplateConfigTransferToPaymentTemplateConfigCriteriaTransfer(
                $paymentTemplateConfigTransfer,
                new PaymentTemplateConfigCriteriaTransfer(),
            );

        return $this->getFactory()->createResponseBuilder()->buildSuccessfulResponse(
            $this->getFactory()->getPaymentTemplateConfigFacade()->findConfig($paymentTemplateConfigCriteriaTransfer),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function postDisconnectAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $glueRequestValidationTransfer = $this->getFactory()->createApiRequestDisconnectValidator()
            ->validate($glueRequestTransfer);

        if (!$glueRequestValidationTransfer->getIsValid()) {
            return $this->getFactory()->createResponseBuilder()
                ->buildRequestNotValidResponse($glueRequestValidationTransfer);
        }

        $disconnectParameterTransfer = $this->getFactory()->createGlueRequestMapper()
            ->mapGlueRequestTransferToDisconnectParametersTransfer($glueRequestTransfer, new DisconnectParametersTransfer());

        $this->getFactory()->getPaymentTemplateConfigFacade()
            ->deleteConfigByStoreReference($disconnectParameterTransfer);

        return $this->getFactory()->createResponseBuilder()->buildSuccessfulResponse();
    }
}
