<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi\Validator;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueRequestValidationTransfer;

class ApiRequestValidator implements ApiRequestValidatorInterface
{
    /**
     * @var array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestValidatorPluginInterface>
     */
    protected $requestValidatorPlugins;

    /**
     * @param array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestValidatorPluginInterface> $requestValidatorPlugins
     */
    public function __construct(array $requestValidatorPlugins)
    {
        $this->requestValidatorPlugins = $requestValidatorPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\GlueRequestValidationTransfer
     */
    public function validate(GlueRequestTransfer $glueRequestTransfer): GlueRequestValidationTransfer
    {
        foreach ($this->requestValidatorPlugins as $validatorPlugin) {
            $glueRequestValidationTransfer = $validatorPlugin->validate($glueRequestTransfer);

            if (!$glueRequestValidationTransfer->getIsValid()) {
                return $glueRequestValidationTransfer;
            }
        }

        return (new GlueRequestValidationTransfer())->setIsValid(true);
    }
}
