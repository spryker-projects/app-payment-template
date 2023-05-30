<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\PaymentTemplateConfigApi\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group PaymentTemplateConfigApi
 * @group Mapper
 * @group PaymentTemplateConfigMapperTest
 * Add your own group annotations below this line
 */
class PaymentTemplateConfigMapperTest extends Unit
{
    /**
     * @var \PyzTest\Glue\PaymentTemplateConfigApi\PaymentTemplateConfigApiTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testMapPaymentTemplateConfigTransferToPaymentTemplateConfigCriteriaTransfer(): void
    {
        // Arrange
        $paymentTemplateConfigMapper = $this->tester->getFactory()->createPaymentTemplateConfigMapper();
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();

        // Act
        $paymentTemplateConfigCriteriaTransfer = $paymentTemplateConfigMapper->mapPaymentTemplateConfigTransferToPaymentTemplateConfigCriteriaTransfer(
            $paymentTemplateConfigTransfer,
            new PaymentTemplateConfigCriteriaTransfer(),
        );

        // Assert
        $this->assertEquals(
            $paymentTemplateConfigTransfer->getStoreReference(),
            $paymentTemplateConfigCriteriaTransfer->getStoreReference(),
        );
    }
}
