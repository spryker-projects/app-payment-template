<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport;

use Spryker\Zed\DataImport\Communication\Plugin\DataImportEventBehaviorPlugin;
use Spryker\Zed\DataImport\Communication\Plugin\DataImportPublisherPlugin;
use Spryker\Zed\DataImport\DataImportDependencyProvider as SprykerDataImportDependencyProvider;
use Spryker\Zed\Kernel\Container;

class DataImportDependencyProvider extends SprykerDataImportDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_STORE = 'store facade';

    /**
     * @var string
     */
    public const FACADE_CURRENCY = 'currency facade';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addStoreFacade($container);
        $container = $this->addUtilEncodingService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container->set(static::FACADE_STORE, function (Container $container) {
            return $container->getLocator()->store()->facade();
        });

        return $container;
    }

    /**
     * @return array
     */
    protected function getDataImporterPlugins(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function getDataImportBeforeImportHookPlugins(): array
    {
        return [
            new DataImportEventBehaviorPlugin(),
        ];
    }

    /**
     * @return array
     */
    protected function getDataImportAfterImportHookPlugins(): array
    {
        return [
            new DataImportEventBehaviorPlugin(),
            new DataImportPublisherPlugin(),
        ];
    }
}
