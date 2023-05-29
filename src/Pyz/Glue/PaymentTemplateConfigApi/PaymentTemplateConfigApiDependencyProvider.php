<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi;

use Pyz\Glue\PaymentTemplateConfigApi\Plugin\RequestValidator\ApiRequestHeaderValidatorPlugin;
use Pyz\Glue\PaymentTemplateConfigApi\Plugin\RequestValidator\ApiRequestPaymentTemplateConfigValidatorPlugin;
use Pyz\Glue\PaymentTemplateConfigApi\Plugin\RequestValidator\ApiRequestStructureValidatorPlugin;
use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;

class PaymentTemplateConfigApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @var string
     */
    public const FACADE_PAYMENT_TEMPLATE_CONFIG = 'FACADE_PAYMENT_TEMPLATE_CONFIG';

    /**
     * @var string
     */
    public const PLUGINS_REQUEST_SAVE_CONFIG_VALIDATOR = 'PLUGINS_REQUEST_SAVE_CONFIG_VALIDATOR';

    /**
     * @var string
     */
    public const PLUGINS_REQUEST_DISCONNECT_VALIDATOR = 'PLUGINS_REQUEST_DISCONNECT_VALIDATOR';

    /**
     * @param \Spryker\Glue\Kernel\Backend\Container $container
     *
     * @return \Spryker\Glue\Kernel\Backend\Container
     */
    public function provideBackendDependencies(Container $container): Container
    {
        $container = parent::provideBackendDependencies($container);

        $container = $this->addUtilEncodingService($container);
        $container = $this->addFacadePaymentTemplateConfig($container);
        $container = $this->addRequestSaveConfigValidatorPlugins($container);
        $container = $this->addRequestDisconnectValidatorPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Backend\Container $container
     *
     * @return \Spryker\Glue\Kernel\Backend\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container->set(static::SERVICE_UTIL_ENCODING, function (Container $container) {
            return $container->getLocator()->utilEncoding()->service();
        });

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Backend\Container $container
     *
     * @return \Spryker\Glue\Kernel\Backend\Container
     */
    protected function addFacadePaymentTemplateConfig(Container $container): Container
    {
        $container->set(static::FACADE_PAYMENT_TEMPLATE_CONFIG, function (Container $container) {
            return $container->getLocator()->paymentTemplateConfig()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Backend\Container $container
     *
     * @return \Spryker\Glue\Kernel\Backend\Container
     */
    protected function addRequestSaveConfigValidatorPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_REQUEST_SAVE_CONFIG_VALIDATOR, function () {
            return $this->getRequestSaveConfigValidatorPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Backend\Container $container
     *
     * @return \Spryker\Glue\Kernel\Backend\Container
     */
    protected function addRequestDisconnectValidatorPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_REQUEST_DISCONNECT_VALIDATOR, function () {
            return $this->getRequestDisconnectValidatorPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestValidatorPluginInterface>
     */
    protected function getRequestSaveConfigValidatorPlugins(): array
    {
        return [
            new ApiRequestHeaderValidatorPlugin(),
            new ApiRequestStructureValidatorPlugin(),
            new ApiRequestPaymentTemplateConfigValidatorPlugin(),
        ];
    }

    /**
     * @return array
     */
    protected function getRequestDisconnectValidatorPlugins(): array
    {
        return [
            new ApiRequestHeaderValidatorPlugin(),
        ];
    }
}
