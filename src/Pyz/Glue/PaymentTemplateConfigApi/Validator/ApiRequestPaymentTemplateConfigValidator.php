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
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiRequestPaymentTemplateConfigValidator implements ApiRequestValidatorInterface
{
    /**
     * @var \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    protected $validator;

    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(
        ValidatorInterface $validator,
        UtilEncodingServiceInterface $utilEncodingService
    ) {
        $this->validator = $validator;
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $glueRequestTransfer
     *
     * @return \Generated\Shared\Transfer\GlueRequestValidationTransfer
     */
    public function validate(GlueRequestTransfer $glueRequestTransfer): GlueRequestValidationTransfer
    {
        $glueRequestValidationTransfer = (new GlueRequestValidationTransfer())
            ->setIsValid(true)->setStatus(Response::HTTP_OK);

        $content = $this->utilEncodingService->decodeJson($glueRequestTransfer->getContent(), true);
        $configuration = $this->utilEncodingService->decodeJson($content['data']['attributes']['configuration'], true);
        $constraintViolationList = $this->validator->validate($configuration, $this->createConstraintForConfiguration());

        if ($constraintViolationList->count() > 0) {
            $glueRequestValidationTransfer
                ->setIsValid(false)
                ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

            /** @var \Symfony\Component\Validator\ConstraintViolationInterface $constraintViolation */
            foreach ($constraintViolationList as $constraintViolation) {
                $glueRequestValidationTransfer->addError(
                    (new GlueErrorTransfer())
                        ->setCode((string)Response::HTTP_UNPROCESSABLE_ENTITY)
                        ->setMessage($constraintViolation->getMessage()),
                );
            }
        }

        return $glueRequestValidationTransfer;
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\Collection
     */
    protected function createConstraintForConfiguration(): Collection
    {
        return new Collection([
            'paymentApiKey' => [
                new Required(),
                $this->createNotBlankConstraint(PaymentTemplateConfigApiConfig::RESPONSE_MESSAGE_BLANK_PAYMENT_API_KEY_FIELD),
                $this->createTypeStringConstraint(PaymentTemplateConfigApiConfig::RESPONSE_MESSAGE_NOT_STRING_PAYMENT_API_KEY_FIELD),
                $this->createStringLengthConstraint(PaymentTemplateConfigApiConfig::RESPONSE_MESSAGE_LENGTH_PAYMENT_API_KEY_FIELD),
            ],
        ], null, null, true);
    }

    /**
     * @param string $errorMessage
     *
     * @return \Symfony\Component\Validator\Constraint
     */
    protected function createNotBlankConstraint(string $errorMessage): Constraint
    {
        $notBlank = new NotBlank();
        $notBlank->message = $errorMessage;

        return $notBlank;
    }

    /**
     * @param string $errorMessage
     *
     * @return \Symfony\Component\Validator\Constraint
     */
    protected function createTypeStringConstraint(string $errorMessage): Constraint
    {
        $type = new Type(['type' => 'string']);
        $type->message = $errorMessage;

        return $type;
    }

    /**
     * @param string $errorMessage
     *
     * @return \Symfony\Component\Validator\Constraint
     */
    protected function createStringLengthConstraint(string $errorMessage): Constraint
    {
        $length = new Length(['value' => 10]);
        $length->exactMessage = $errorMessage;

        return $length;
    }
}
