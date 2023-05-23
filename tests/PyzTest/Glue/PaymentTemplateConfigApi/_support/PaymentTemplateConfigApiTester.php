<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\PaymentTemplateConfigApi;

use Codeception\Actor;
use Codeception\Test\Feature\Stub;
use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueRequestValidationTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Pyz\Glue\PaymentTemplateConfigApi\PaymentTemplateConfigApiConfig;
use Symfony\Component\HttpFoundation\Response;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class PaymentTemplateConfigApiTester extends Actor
{
    use _generated\PaymentTemplateConfigApiTesterActions;

    use Stub;

    /**
     * @var array
     */
    protected const REQUEST_CONTENT_FIELDS = [
        'paymentApiKey',
    ];

    /**
     * @return \Generated\Shared\Transfer\GlueRequestValidationTransfer
     */
    public function haveGlueRequestValidationTransferWithError(): GlueRequestValidationTransfer
    {
        return (new GlueRequestValidationTransfer())
            ->setIsValid(false)
            ->addError(
                (new GlueErrorTransfer())
                    ->setStatus(111)
                    ->setCode('222')
                    ->setMessage('Message'),
            );
    }

    /**
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function haveGlueResponseWithRequestValidationError(): GlueResponseTransfer
    {
        return (new GlueResponseTransfer())
            ->setContent('{"errors":[{"code":"222","detail":"Message","status":111}]}')
            ->setHttpStatus(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer
     */
    public function havePaymentTemplateConfigResponseTransferWithError(): PaymentTemplateConfigResponseTransfer
    {
        return (new PaymentTemplateConfigResponseTransfer())
            ->setIsSuccessful(false)
            ->addErrorMessage('Error Message');
    }

    /**
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function haveGlueResponseWithPaymentTemplateConfigResponseError(): GlueResponseTransfer
    {
        return (new GlueResponseTransfer())
            ->setContent('{"errors":[{"code":422,"detail":"Error Message","status":422}]}')
            ->setHttpStatus(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function havePaymentTemplateConfigTransferWithOnlyStoreReference(): PaymentTemplateConfigTransfer
    {
        $paymentTemplateConfigTransfer = $this->havePaymentTemplateConfigTransfer();

        return (new PaymentTemplateConfigTransfer())->setStoreReference($paymentTemplateConfigTransfer->getStoreReference());
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function haveSuccessfulPaymentTemplateConfigResponse(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): GlueResponseTransfer
    {
        return (new GlueResponseTransfer())
            ->setContent(
                json_encode(
                    [
                        'storeReference' => $paymentTemplateConfigTransfer->getStoreReference(),
                        'configuration' => $paymentTemplateConfigTransfer->modifiedToArray(),
                    ],
                ),
            )
            ->setHttpStatus(Response::HTTP_OK);
    }

    /**
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function haveSuccessfulEmptyGlueResponse(): GlueResponseTransfer
    {
        return (new GlueResponseTransfer())->setHttpStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\GlueRequestTransfer
     */
    public function buildValidGlueRequestTransfer(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): GlueRequestTransfer
    {
        $configuration = $this->prepareConfigurationForRequest($paymentTemplateConfigTransfer);

        $content = $this->prepareContent($configuration);

        return $this->prepareGlueRequestTransfer($paymentTemplateConfigTransfer->getStoreReference(), $content);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\GlueRequestTransfer
     */
    public function haveGlueRequestTransferWithWrongConfiguration(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): GlueRequestTransfer
    {
        $content = $this->prepareContent('wrong_json');

        return $this->prepareGlueRequestTransfer($paymentTemplateConfigTransfer->getStoreReference(), $content);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return string
     */
    protected function prepareConfigurationForRequest(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): string
    {
        return json_encode(
            array_filter(
                $paymentTemplateConfigTransfer->toArrayNotRecursiveCamelCased(),
                fn ($key) => in_array($key, static::REQUEST_CONTENT_FIELDS, true),
                ARRAY_FILTER_USE_KEY,
            ),
        );
    }

    /**
     * @param string $configuration
     *
     * @return string
     */
    protected function prepareContent(string $configuration): string
    {
        $content = [
            'data' => [
                'type' => 'configuration',
                'attributes' => [
                    'configuration' => $configuration,
                ],
            ],
        ];

        return json_encode($content);
    }

    /**
     * @param string $storeReference
     * @param string $content
     *
     * @return \Generated\Shared\Transfer\GlueRequestTransfer
     */
    public function prepareGlueRequestTransfer(string $storeReference, string $content): GlueRequestTransfer
    {
        return (new GlueRequestTransfer())
            ->setMeta(
                [
                    PaymentTemplateConfigApiConfig::HEADER_STORE_REFERENCE => [
                        $storeReference,
                    ],
                ],
            )
            ->setContent($content);
    }
}
