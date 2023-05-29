<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\PaymentTemplateConfigApi\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\DisconnectParametersTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group PaymentTemplateConfigApi
 * @group Mapper
 * @group GlueRequestMapperTest
 * Add your own group annotations below this line
 */
class GlueRequestMapperTest extends Unit
{
    /**
     * @var \PyzTest\Glue\PaymentTemplateConfigApi\PaymentTemplateConfigApiTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testMapGlueRequestTransferToPaymentTemplateConfigTransfer(): void
    {
        // Arrange
        $glueRequestMapper = $this->tester->getFactory()->createGlueRequestMapper();
        $expectedPaymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();
        $glueRequestTransfer = $this->tester->buildValidGlueRequestTransfer($expectedPaymentTemplateConfigTransfer);
        $expectedPaymentTemplateConfigTransfer->setIdPaymentTemplateConfig(null);

        // Act
        $paymentTemplateConfigTransfer = $glueRequestMapper->mapGlueRequestTransferToPaymentTemplateConfigTransfer(
            $glueRequestTransfer,
            new PaymentTemplateConfigTransfer(),
        );

        // Assert
        $this->assertEquals($expectedPaymentTemplateConfigTransfer->toArray(), $paymentTemplateConfigTransfer->toArray());
    }

    /**
     * @return void
     */
    public function testMapGlueRequestTransferToDisconnectParametersTransfer(): void
    {
        // Arrange
        $glueRequestMapper = $this->tester->getFactory()->createGlueRequestMapper();
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();
        $glueRequestTransfer = $this->tester->buildValidGlueRequestTransfer($paymentTemplateConfigTransfer);
        $expectedDisconnectParametersTransfer = $this->tester
            ->haveDisconnectParametersTransfer(['storeReference' => $paymentTemplateConfigTransfer->getStoreReference()]);

        // Act
        $disconnectParametersTransfer = $glueRequestMapper
            ->mapGlueRequestTransferToDisconnectParametersTransfer($glueRequestTransfer, new DisconnectParametersTransfer());

        // Assert
        $this->assertEquals($expectedDisconnectParametersTransfer->toArray(), $disconnectParametersTransfer->toArray());
    }
}
