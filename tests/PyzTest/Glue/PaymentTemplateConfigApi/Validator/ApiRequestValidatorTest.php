<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\PaymentTemplateConfigApi\Validator;

use Codeception\Test\Unit;
use Symfony\Component\HttpFoundation\Response;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group PaymentTemplateConfigApi
 * @group Validator
 * @group ApiRequestValidatorTest
 * Add your own group annotations below this line
 */
class ApiRequestValidatorTest extends Unit
{
    /**
     * @var \PyzTest\Glue\PaymentTemplateConfigApi\PaymentTemplateConfigApiTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testValidationSaveConfigIsSuccessful(): void
    {
        // Arrange
        $validator = $this->tester->getFactory()->createApiRequestSaveConfigValidator();
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();
        $validGlueRequestTransfer = $this->tester->buildValidGlueRequestTransfer($paymentTemplateConfigTransfer);

        // Act
        $glueRequestValidationTransfer = $validator->validate($validGlueRequestTransfer);

        // Assert
        $this->assertTrue($glueRequestValidationTransfer->getIsValid());
    }

    /**
     * @return void
     */
    public function testValidationSaveConfigFailsOnMissingXStoreReference(): void
    {
        // Arrange
        $validator = $this->tester->getFactory()->createApiRequestSaveConfigValidator();
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();
        $validGlueRequestTransfer = $this->tester->buildValidGlueRequestTransfer($paymentTemplateConfigTransfer);
        $validGlueRequestTransfer->setMeta([]);

        // Act
        $glueRequestValidationTransfer = $validator->validate($validGlueRequestTransfer);

        // Assert
        $this->assertFalse($glueRequestValidationTransfer->getIsValid());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $glueRequestValidationTransfer->getStatus());
        $this->assertCount(1, $glueRequestValidationTransfer->getErrors());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $glueRequestValidationTransfer->getErrors()[0]->getCode());
        $this->assertEquals('X-Store-Reference in header is required.', $glueRequestValidationTransfer->getErrors()[0]->getMessage());
    }

    /**
     * @return void
     */
    public function testValidationSaveConfigFailsOnWrongStructure(): void
    {
        // Arrange
        $validator = $this->tester->getFactory()->createApiRequestSaveConfigValidator();
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();
        $validGlueRequestTransfer = $this->tester->buildValidGlueRequestTransfer($paymentTemplateConfigTransfer);
        $validGlueRequestTransfer->setContent(json_encode(['some_content' => 'I am wrong']));

        // Act
        $glueRequestValidationTransfer = $validator->validate($validGlueRequestTransfer);

        // Assert
        $this->assertFalse($glueRequestValidationTransfer->getIsValid());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $glueRequestValidationTransfer->getStatus());
        $this->assertCount(1, $glueRequestValidationTransfer->getErrors());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $glueRequestValidationTransfer->getErrors()[0]->getCode());
        $this->assertEquals('Wrong request format.', $glueRequestValidationTransfer->getErrors()[0]->getMessage());
    }

    /**
     * @return void
     */
    public function testValidationSaveConfigFailsOnMissingConfigurationData(): void
    {
        // Arrange
        $validator = $this->tester->getFactory()->createApiRequestSaveConfigValidator();
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();
        $glueRequestTransfer = $this->tester->haveGlueRequestTransferWithWrongConfiguration($paymentTemplateConfigTransfer);

        // Act
        $glueRequestValidationTransfer = $validator->validate($glueRequestTransfer);

        // Assert
        $this->assertFalse($glueRequestValidationTransfer->getIsValid());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $glueRequestValidationTransfer->getStatus());
        $this->assertCount(1, $glueRequestValidationTransfer->getErrors());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $glueRequestValidationTransfer->getErrors()[0]->getCode());
        $this->assertEquals('Wrong request format.', $glueRequestValidationTransfer->getErrors()[0]->getMessage());
    }

    /**
     * @return void
     */
    public function testValidationSaveConfigFailsOnWrongConfigurationData(): void
    {
        // Arrange
        $validator = $this->tester->getFactory()->createApiRequestSaveConfigValidator();
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransferWithOnlyStoreReference();
        $glueRequestTransfer = $this->tester->buildValidGlueRequestTransfer($paymentTemplateConfigTransfer);

        // Act
        $glueRequestValidationTransfer = $validator->validate($glueRequestTransfer);

        // Assert
        $this->assertFalse($glueRequestValidationTransfer->getIsValid());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $glueRequestValidationTransfer->getStatus());
        $this->assertCount(1, $glueRequestValidationTransfer->getErrors());
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $glueRequestValidationTransfer->getErrors()[0]->getCode());
        $this->assertEquals('Payment API Key must not be blank.', $glueRequestValidationTransfer->getErrors()[0]->getMessage());
    }

    /**
     * @return void
     */
    public function testValidationDisconnectIsSuccessful(): void
    {
        // Arrange
        $validator = $this->tester->getFactory()->createApiRequestDisconnectValidator();
        $validGlueRequestTransfer = $this->tester->prepareGlueRequestTransfer('storeReference', '');

        // Act
        $glueRequestValidationTransfer = $validator->validate($validGlueRequestTransfer);

        // Assert
        $this->assertTrue($glueRequestValidationTransfer->getIsValid());
    }

    /**
     * @return void
     */
    public function testValidationDisconnectIsFails(): void
    {
        // Arrange
        $validator = $this->tester->getFactory()->createApiRequestDisconnectValidator();
        $validGlueRequestTransfer = $this->tester->prepareGlueRequestTransfer('', '');

        // Act
        $glueRequestValidationTransfer = $validator->validate($validGlueRequestTransfer);

        // Assert
        $this->assertFalse($glueRequestValidationTransfer->getIsValid());
    }
}
