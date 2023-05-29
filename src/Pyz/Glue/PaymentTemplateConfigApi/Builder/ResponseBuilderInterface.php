<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi\Builder;

use Generated\Shared\Transfer\GlueRequestValidationTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;

interface ResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\GlueRequestValidationTransfer $glueRequestValidationTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function buildRequestNotValidResponse(
        GlueRequestValidationTransfer $glueRequestValidationTransfer
    ): GlueResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer $paymentTemplateConfigResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function buildCredentialsSaveErrorResponse(
        PaymentTemplateConfigResponseTransfer $paymentTemplateConfigResponseTransfer
    ): GlueResponseTransfer;

    /**
     * @param string $errorMessage
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function buildErrorResponse(string $errorMessage): GlueResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer|null $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function buildSuccessfulResponse(?PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer = null): GlueResponseTransfer;
}
