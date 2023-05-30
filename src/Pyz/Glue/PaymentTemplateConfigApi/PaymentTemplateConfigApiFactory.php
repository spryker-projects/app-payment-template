<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi;

use Pyz\Glue\PaymentTemplateConfigApi\Builder\ResponseBuilder;
use Pyz\Glue\PaymentTemplateConfigApi\Builder\ResponseBuilderInterface;
use Pyz\Glue\PaymentTemplateConfigApi\Mapper\GlueRequestMapper;
use Pyz\Glue\PaymentTemplateConfigApi\Mapper\GlueRequestMapperInterface;
use Pyz\Glue\PaymentTemplateConfigApi\Mapper\PaymentTemplateConfigMapper;
use Pyz\Glue\PaymentTemplateConfigApi\Mapper\PaymentTemplateConfigMapperInterface;
use Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestHeaderValidator;
use Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestPaymentTemplateConfigValidator;
use Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestStructureValidator;
use Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestValidator;
use Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestValidatorInterface;
use Pyz\Zed\PaymentTemplateConfig\Business\PaymentTemplateConfigFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PaymentTemplateConfigApiFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): UtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(PaymentTemplateConfigApiDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return \Pyz\Zed\PaymentTemplateConfig\Business\PaymentTemplateConfigFacadeInterface
     */
    public function getPaymentTemplateConfigFacade(): PaymentTemplateConfigFacadeInterface
    {
        return $this->getProvidedDependency(PaymentTemplateConfigApiDependencyProvider::FACADE_PAYMENT_TEMPLATE_CONFIG);
    }

    /**
     * @return \Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestValidatorInterface
     */
    public function createApiRequestHeaderValidator(): ApiRequestValidatorInterface
    {
        return new ApiRequestHeaderValidator();
    }

    /**
     * @return \Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestValidatorInterface
     */
    public function createApiRequestStructureValidator(): ApiRequestValidatorInterface
    {
        return new ApiRequestStructureValidator(
            $this->createValidator(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestValidatorInterface
     */
    public function createApiRequestPaymentTemplateConfigValidator(): ApiRequestValidatorInterface
    {
        return new ApiRequestPaymentTemplateConfigValidator(
            $this->createValidator(),
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \Pyz\Glue\PaymentTemplateConfigApi\Builder\ResponseBuilderInterface
     */
    public function createResponseBuilder(): ResponseBuilderInterface
    {
        return new ResponseBuilder($this->getUtilEncodingService());
    }

    /**
     * @return \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    public function createValidator(): ValidatorInterface
    {
        return Validation::createValidator();
    }

    /**
     * @return \Pyz\Glue\PaymentTemplateConfigApi\Mapper\GlueRequestMapperInterface
     */
    public function createGlueRequestMapper(): GlueRequestMapperInterface
    {
        return new GlueRequestMapper(
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \Pyz\Glue\PaymentTemplateConfigApi\Mapper\PaymentTemplateConfigMapperInterface
     */
    public function createPaymentTemplateConfigMapper(): PaymentTemplateConfigMapperInterface
    {
        return new PaymentTemplateConfigMapper();
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestValidatorPluginInterface>
     */
    public function getApiRequestSaveConfigValidatorPlugins(): array
    {
        return $this->getProvidedDependency(PaymentTemplateConfigApiDependencyProvider::PLUGINS_REQUEST_SAVE_CONFIG_VALIDATOR);
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestValidatorPluginInterface>
     */
    public function getApiRequestDisconnectValidatorPlugins(): array
    {
        return $this->getProvidedDependency(PaymentTemplateConfigApiDependencyProvider::PLUGINS_REQUEST_DISCONNECT_VALIDATOR);
    }

    /**
     * @return \Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestValidatorInterface
     */
    public function createApiRequestSaveConfigValidator(): ApiRequestValidatorInterface
    {
        return new ApiRequestValidator($this->getApiRequestSaveConfigValidatorPlugins());
    }

    /**
     * @return \Pyz\Glue\PaymentTemplateConfigApi\Validator\ApiRequestValidatorInterface
     */
    public function createApiRequestDisconnectValidator(): ApiRequestValidatorInterface
    {
        return new ApiRequestValidator($this->getApiRequestDisconnectValidatorPlugins());
    }
}
