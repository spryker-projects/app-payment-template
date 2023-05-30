<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi\Validator;

use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueRequestValidationTransfer;
use Pyz\Glue\PaymentTemplateConfigApi\PaymentTemplateConfigApiConfig;
use Symfony\Component\HttpFoundation\Response;

class ApiRequestHeaderValidator implements ApiRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\GlueRequestValidationTransfer
     */
    public function validate(GlueRequestTransfer $glueRequestTransfer): GlueRequestValidationTransfer
    {
        $glueRequestValidationTransfer = (new GlueRequestValidationTransfer())
            ->setIsValid(true)->setStatus(Response::HTTP_OK);

        $meta = $glueRequestTransfer->getMeta();

        if (empty($meta[PaymentTemplateConfigApiConfig::HEADER_STORE_REFERENCE][0])) {
            $glueRequestValidationTransfer
                ->setIsValid(false)
                ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->addError(
                    (new GlueErrorTransfer())
                        ->setCode((string)Response::HTTP_UNPROCESSABLE_ENTITY)
                        ->setMessage(PaymentTemplateConfigApiConfig::RESPONSE_MESSAGE_MISSING_STORE_REFERENCE),
                );
        }

        return $glueRequestValidationTransfer;
    }
}
