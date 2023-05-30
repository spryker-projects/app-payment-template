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
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiRequestStructureValidator implements ApiRequestValidatorInterface
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
            ->setIsValid(true)
            ->setStatus(Response::HTTP_OK);

        $content = $this->utilEncodingService->decodeJson($glueRequestTransfer->getContent(), true);
        $constraintViolationList = $this->validator->validate($content, $this->getConstraintForRequestStructure());

        if ($constraintViolationList->count() > 0) {
            $glueRequestValidationTransfer
                ->setIsValid(false)
                ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

            $glueRequestValidationTransfer->addError(
                (new GlueErrorTransfer())
                    ->setCode((string)Response::HTTP_UNPROCESSABLE_ENTITY)
                    ->setMessage(PaymentTemplateConfigApiConfig::RESPONSE_MESSAGE_VALIDATION_FORMAT_ERROR_MESSAGE),
            );
        }

        return $glueRequestValidationTransfer;
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\Collection
     */
    protected function getConstraintForRequestStructure(): Collection
    {
        return new Collection([
            'data' => new Collection([
                'type' => new EqualTo(PaymentTemplateConfigApiConfig::REQUEST_DATA_TYPE),
                'attributes' => new Collection([
                    'configuration' => [
                        new Required(),
                        new NotBlank(),
                        new Type(['type' => 'string']),
                        new Json(),
                    ],
                ]),
            ]),
        ]);
    }
}
