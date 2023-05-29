<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\SecretsManager;

use Spryker\Client\SecretsManager\SecretsManagerDependencyProvider as SprykerSecretsManagerDependencyProvider;
use Spryker\Client\SecretsManagerAws\Plugin\SecretsManager\SecretsManagerAwsProviderPlugin;
use Spryker\Client\SecretsManagerExtension\Dependency\Plugin\SecretsManagerProviderPluginInterface;

class SecretsManagerDependencyProvider extends SprykerSecretsManagerDependencyProvider
{
    /**
     * @return \Spryker\Client\SecretsManagerExtension\Dependency\Plugin\SecretsManagerProviderPluginInterface
     */
    protected function getSecretsManagerProviderPlugin(): SecretsManagerProviderPluginInterface
    {
        return new SecretsManagerAwsProviderPlugin();
    }
}
