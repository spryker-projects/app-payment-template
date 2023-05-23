<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator;

use Closure;

interface TenantPropelEncryptionConfiguratorInterface
{
    /**
     * @param string $tenantIdentifier
     *
     * @return bool
     */
    public function configurePropelEncryption(string $tenantIdentifier): bool;

    /**
     * @param \Closure $callback
     *
     * @return mixed
     */
    public function withCurrentOrEmptyEncryptionKey(Closure $callback);
}
