<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator;

use Closure;
use Exception;
use Generated\Shared\Transfer\SecretKeyTransfer;
use Generated\Shared\Transfer\SecretTransfer;
use Spryker\Client\SecretsManager\SecretsManagerClientInterface;
use Spryker\PropelEncryptionBehavior\Cipher;
use Spryker\Shared\Log\LoggerTrait;

class TenantPropelEncryptionConfigurator implements TenantPropelEncryptionConfiguratorInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    protected const SECRET_KEY_PREFIX_TENANT_KEY = 'tenant_key';

    /**
     * @var \Spryker\Client\SecretsManager\SecretsManagerClientInterface
     */
    protected $secretsManagerClient;

    /**
     * @param \Spryker\Client\SecretsManager\SecretsManagerClientInterface $secretsManagerClient
     */
    public function __construct(SecretsManagerClientInterface $secretsManagerClient)
    {
        $this->secretsManagerClient = $secretsManagerClient;
    }

    /**
     * @param string $tenantIdentifier
     *
     * @return bool
     */
    public function configurePropelEncryption(string $tenantIdentifier): bool
    {
        $passphrase = $this->getPassphrase($tenantIdentifier);

        if (!$passphrase) {
            $this->getLogger()->error(sprintf(
                'The secret passphrase was not found using $tenantIdentifier: `%s`.',
                $tenantIdentifier,
            ));

            Cipher::resetInstance();

            return false;
        }

        Cipher::resetInstance();
        Cipher::createInstance($passphrase);

        return true;
    }

    /**
     * @param string $tenantIdentifier
     *
     * @return string|null
     */
    protected function getPassphrase(string $tenantIdentifier): ?string
    {
        $secretKeyTransfer = (new SecretKeyTransfer())
            ->setIdentifier($tenantIdentifier)
            ->setPrefix(static::SECRET_KEY_PREFIX_TENANT_KEY);
        $secretTransfer = (new SecretTransfer())
            ->setSecretKey($secretKeyTransfer);

        $secretTransfer = $this->secretsManagerClient->getSecret($secretTransfer);

        return $secretTransfer->getValue();
    }

    /**
     * @inheritDoc
     */
    public function withCurrentOrEmptyEncryptionKey(Closure $callback)
    {
        try {
            Cipher::getInstance();
            $reset = false;
        } catch (Exception $exception) {
            // if no cipher is instantiated, create an empty one to allow reading unencrypted values as-is
            Cipher::createInstance('');
            $reset = true;
        }

        $callbackResult = $callback();

        if ($reset) {
            Cipher::resetInstance();
        }

        return $callbackResult;
    }
}
