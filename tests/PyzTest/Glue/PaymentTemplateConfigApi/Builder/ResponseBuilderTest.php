<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\PaymentTemplateConfigApi\Builder;

use Codeception\Test\Unit;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group PaymentTemplateConfigApi
 * @group Builder
 * @group ResponseBuilderTest
 * Add your own group annotations below this line
 */
class ResponseBuilderTest extends Unit
{
    /**
     * @var \PyzTest\Glue\PaymentTemplateConfigApi\PaymentTemplateConfigApiTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testBuildRequestNotValidResponse(): void
    {
        // Arrange
        $responseBuilder = $this->tester->getFactory()->createResponseBuilder();
        $glueRequestValidationTransfer = $this->tester->haveGlueRequestValidationTransferWithError();
        $expectedGlueResponse = $this->tester->haveGlueResponseWithRequestValidationError();

        // Act
        $glueResponse = $responseBuilder->buildRequestNotValidResponse($glueRequestValidationTransfer);

        // Assert
        $this->assertEquals($expectedGlueResponse, $glueResponse);
    }

    /**
     * @return void
     */
    public function testBuildCredentialsSaveErrorResponse(): void
    {
        // Arrange
        $responseBuilder = $this->tester->getFactory()->createResponseBuilder();
        $paymentTemplateConfigResponse = $this->tester->havePaymentTemplateConfigResponseTransferWithError();
        $expectedGlueResponse = $this->tester->haveGlueResponseWithPaymentTemplateConfigResponseError();

        // Act
        $glueResponse = $responseBuilder->buildCredentialsSaveErrorResponse($paymentTemplateConfigResponse);

        // Assert
        $this->assertEquals($expectedGlueResponse, $glueResponse);
    }

    /**
     * @return void
     */
    public function testBuildSuccessfulResponse(): void
    {
        // Arrange
        $responseBuilder = $this->tester->getFactory()->createResponseBuilder();
        $paymentTemplateConfigTransfer = $this->tester->havePaymentTemplateConfigTransfer();
        $expectedGlueResponse = $this->tester->haveSuccessfulPaymentTemplateConfigResponse($paymentTemplateConfigTransfer);

        // Act
        $glueResponse = $responseBuilder->buildSuccessfulResponse($paymentTemplateConfigTransfer);

        // Assert
        $this->assertEquals($expectedGlueResponse, $glueResponse);
    }

    /**
     * @return void
     */
    public function testBuildErrorResponse(): void
    {
        // Arrange
        $responseBuilder = $this->tester->getFactory()->createResponseBuilder();
        $expectedGlueResponse = $this->tester->haveGlueResponseWithPaymentTemplateConfigResponseError();

        // Act
        $glueResponse = $responseBuilder->buildErrorResponse('Error Message');

        // Assert
        $this->assertEquals($expectedGlueResponse, $glueResponse);
    }

    /**
     * @return void
     */
    public function testBuildSuccessfulEmptyResponse(): void
    {
        // Arrange
        $responseBuilder = $this->tester->getFactory()->createResponseBuilder();
        $expectedGlueResponse = $this->tester->haveSuccessfulEmptyGlueResponse();

        // Act
        $glueResponse = $responseBuilder->buildSuccessfulResponse();

        // Assert
        $this->assertEquals($expectedGlueResponse, $glueResponse);
    }
}
