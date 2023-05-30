<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi\Mapper;

use Generated\Shared\Transfer\DisconnectParametersTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Pyz\Glue\PaymentTemplateConfigApi\PaymentTemplateConfigApiConfig;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class GlueRequestMapper implements GlueRequestMapperInterface
{
    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(UtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function mapGlueRequestTransferToPaymentTemplateConfigTransfer(
        GlueRequestTransfer $glueRequestTransfer,
        PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
    ): PaymentTemplateConfigTransfer {
        $storeReference = $this->getStoreReference($glueRequestTransfer);

        $configuration = $this->getConfiguration($glueRequestTransfer);

        return $paymentTemplateConfigTransfer->fromArray($configuration, true)->setStoreReference($storeReference);
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     * @param \Generated\Shared\Transfer\DisconnectParametersTransfer $disconnectParametersTransfer
     *
     * @return \Generated\Shared\Transfer\DisconnectParametersTransfer
     */
    public function mapGlueRequestTransferToDisconnectParametersTransfer(
        GlueRequestTransfer $glueRequestTransfer,
        DisconnectParametersTransfer $disconnectParametersTransfer
    ): DisconnectParametersTransfer {
        return $disconnectParametersTransfer->setStoreReference($this->getStoreReference($glueRequestTransfer));
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return string
     */
    protected function getStoreReference(GlueRequestTransfer $glueRequestTransfer): string
    {
        return $glueRequestTransfer->getMeta()[PaymentTemplateConfigApiConfig::HEADER_STORE_REFERENCE][0];
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return array<string, string>
     */
    protected function getConfiguration(GlueRequestTransfer $glueRequestTransfer): array
    {
        $content = $this->utilEncodingService->decodeJson($glueRequestTransfer->getContent(), true);

        return $this->utilEncodingService->decodeJson($content['data']['attributes']['configuration'], true);
    }
}
