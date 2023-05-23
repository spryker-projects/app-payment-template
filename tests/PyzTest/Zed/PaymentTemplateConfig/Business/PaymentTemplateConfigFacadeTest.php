<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\PaymentTemplateConfig\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer;
use Spryker\PropelEncryptionBehavior\Cipher;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group PaymentTemplateConfig
 * @group Business
 * @group Facade
 * @group PaymentTemplateConfigFacadeTest
 * Add your own group annotations below this line
 */
class PaymentTemplateConfigFacadeTest extends Unit
{
    /**
     * @var \PyzTest\Zed\PaymentTemplateConfig\PaymentTemplateConfigBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testSaveConfigurationSuccessful(): void
    {
        // Arrange
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();
        $this->tester->addSpyPaymentTemplateConfigCleanupByStoreReference($paymentTemplateConfigTransfer->getStoreReference());

        // Act
        $paymentTemplateConfigResponseTransfer = $this->tester->getFacade()->saveConfig($paymentTemplateConfigTransfer);

        // Assert
        $this->assertTrue($paymentTemplateConfigResponseTransfer->getIsSuccessful());
        $this->tester->assertPaymentTemplateConfigIsPersisted($paymentTemplateConfigTransfer);
    }

    /**
     * @return void
     */
    public function testUpdateConfigurationSuccessful(): void
    {
        // Arrange
        $persistedPaymentTemplateConfigResponseTransfer = $this->tester->havePersistedPaymentTemplateConfig();
        $updatedPaymentTemplateConfigResponseTransfer = $this->tester->getUpdatedPaymentTemplateConfigResponseTransfer(
            $persistedPaymentTemplateConfigResponseTransfer,
        );

        // Act
        $paymentTemplateConfigResponseTransfer = $this->tester->getFacade()->saveConfig($updatedPaymentTemplateConfigResponseTransfer);

        // Assert
        $this->assertTrue($paymentTemplateConfigResponseTransfer->getIsSuccessful());
        $this->tester->assertPaymentTemplateConfigIsPersisted($updatedPaymentTemplateConfigResponseTransfer);
    }

    /**
     * @return void
     */
    public function testConfigNotFoundIfItDoesNotExist(): void
    {
        // Arrange
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();

        // Act
        $paymentTemplateConfigResponseTransfer = $this->tester->getFacade()->findConfig(
            (new PaymentTemplateConfigCriteriaTransfer())->fromArray($paymentTemplateConfigTransfer->toArray(), true),
        );

        // Assert
        $this->assertNull($paymentTemplateConfigResponseTransfer);
    }

    /**
     * @return void
     */
    public function testConfigSuccessfullyFound(): void
    {
        // Arrange
        $persistedPaymentTemplateConfigResponseTransfer = $this->tester->havePersistedPaymentTemplateConfig();

        // Act
        $paymentTemplateConfigResponseTransfer = $this->tester->getFacade()->findConfig(
            (new PaymentTemplateConfigCriteriaTransfer())->fromArray($persistedPaymentTemplateConfigResponseTransfer->toArray(), true),
        );

        // Assert
        $this->tester->assertProperPaymentTemplateConfigFound($paymentTemplateConfigResponseTransfer, $persistedPaymentTemplateConfigResponseTransfer);
    }

    /**
     * @return void
     */
    public function testDeleteConfigByStoreReference(): void
    {
        // Arrange
        $persistedPaymentTemplateConfigTransfer = $this->tester->havePersistedPaymentTemplateConfig();
        $disconnectParametersTransfer = $this->tester->haveDisconnectParametersTransfer(
            [
                'storeReference' => $persistedPaymentTemplateConfigTransfer->getStoreReference(),
            ],
        );

        // Act
        $this->tester->getFacade()->deleteConfigByStoreReference($disconnectParametersTransfer);

        // Assert
        $this->tester->assertPaymentTemplateConfigIsNotPersisted($persistedPaymentTemplateConfigTransfer);
    }

    /**
     * @return void
     */
    public function testHasConfigReturnsFalseOnMissingStoreReference(): void
    {
        $paymentTemplateConfig = $this->tester->havePaymentTemplateConfigTransfer();

        $criteria = new PaymentTemplateConfigCriteriaTransfer();
        $criteria->setStoreReference($paymentTemplateConfig->getStoreReferenceOrFail());

        $this->assertFalse($this->tester->getFacade()->hasConfig($criteria));
    }

    /**
     * @return void
     */
    public function testHasConfigReturnsTrueOnFoundStoreReference(): void
    {
        $paymentTemplateConfig = $this->tester->havePersistedPaymentTemplateConfig();

        $criteria = new PaymentTemplateConfigCriteriaTransfer();
        $criteria->setStoreReference($paymentTemplateConfig->getStoreReferenceOrFail());

        $this->assertTrue($this->tester->getFacade()->hasConfig($criteria));
    }

    /**
     * @return void
     */
    public function testHasConfigWorksWithoutCipherInstance(): void
    {
        $paymentTemplateConfig = $this->tester->havePersistedPaymentTemplateConfig();

        $criteria = new PaymentTemplateConfigCriteriaTransfer();
        $criteria->setStoreReference($paymentTemplateConfig->getStoreReferenceOrFail());

        Cipher::resetInstance();

        $this->assertTrue($this->tester->getFacade()->hasConfig($criteria));
    }
}
