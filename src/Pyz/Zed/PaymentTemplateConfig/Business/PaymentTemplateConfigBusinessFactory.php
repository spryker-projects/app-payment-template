<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Business;

use Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator\TenantPropelEncryptionConfigurator;
use Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator\TenantPropelEncryptionConfiguratorInterface;
use Pyz\Zed\PaymentTemplateConfig\Business\Reader\ConfigReader;
use Pyz\Zed\PaymentTemplateConfig\Business\Reader\ConfigReaderInterface;
use Pyz\Zed\PaymentTemplateConfig\Business\Saver\ConfigSaver;
use Pyz\Zed\PaymentTemplateConfig\PaymentTemplateConfigDependencyProvider;
use Spryker\Client\SecretsManager\SecretsManagerClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigRepositoryInterface getRepository()
 * @method \Pyz\Zed\PaymentTemplateConfig\PaymentTemplateConfigConfig getConfig()
 */
class PaymentTemplateConfigBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\PaymentTemplateConfig\Business\Saver\ConfigSaver
     */
    public function createConfigurationSaver(): ConfigSaver
    {
        return new ConfigSaver(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->createTenantPropelEncryptionConfigurator(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Spryker\Client\SecretsManager\SecretsManagerClientInterface
     */
    public function getSecretsManagerClient(): SecretsManagerClientInterface
    {
        return $this->getProvidedDependency(PaymentTemplateConfigDependencyProvider::CLIENT_SECRETS_MANAGER);
    }

    /**
     * @return \Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator\TenantPropelEncryptionConfiguratorInterface
     */
    public function createTenantPropelEncryptionConfigurator(): TenantPropelEncryptionConfiguratorInterface
    {
        return new TenantPropelEncryptionConfigurator(
            $this->getSecretsManagerClient(),
        );
    }

    /**
     * @return \Pyz\Zed\PaymentTemplateConfig\Business\Reader\ConfigReaderInterface
     */
    public function createConfigReader(): ConfigReaderInterface
    {
        return new ConfigReader(
            $this->getRepository(),
            $this->createTenantPropelEncryptionConfigurator(),
        );
    }
}
