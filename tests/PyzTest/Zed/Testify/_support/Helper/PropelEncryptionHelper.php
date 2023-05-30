<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\Testify\Helper;

use Codeception\Lib\Framework;
use Codeception\Stub;
use Codeception\TestInterface;
use Generated\Shared\Transfer\SecretTransfer;
use Spryker\Client\SecretsManager\SecretsManagerClientInterface;
use Spryker\PropelEncryptionBehavior\Cipher;
use SprykerTest\Zed\Testify\Helper\Business\DependencyProviderHelperTrait;

class PropelEncryptionHelper extends Framework
{
    use DependencyProviderHelperTrait;

    /**
     * @var string
     */
    protected const TEST_SECRET_PASSPHRASE = 'my_secret_passphrase';

    /**
     * @var string
     */
    protected const CLIENT_SECRETS_MANAGER = 'CLIENT_SECRETS_MANAGER';

    /**
     * @param \Codeception\TestInterface $test
     *
     * @return void
     */
    public function _before(TestInterface $test): void
    {
        parent::_before($test);

        $this->resetPropelEncryption();
        $this->initiatePropelEncryptionWithTestPassphrase();

        $secretTransfer = (new SecretTransfer())
            ->setValue(static::TEST_SECRET_PASSPHRASE);

        $mockSecretsManagerClient = Stub::makeEmpty(
            SecretsManagerClientInterface::class,
            [
                'getSecret' => $secretTransfer,
                'createSecret' => true,
            ],
        );

        $this->getDependencyProviderHelper()->setDependency(static::CLIENT_SECRETS_MANAGER, $mockSecretsManagerClient);
    }

    /**
     * @param \Codeception\TestInterface $test
     *
     * @return void
     */
    public function _after(TestInterface $test): void
    {
        parent::_after($test);

        $this->resetPropelEncryption();
    }

    /**
     * @return void
     */
    public function initiatePropelEncryptionWithTestPassphrase(): void
    {
        Cipher::createInstance(static::TEST_SECRET_PASSPHRASE);
    }

    /**
     * @return void
     */
    public function resetPropelEncryption(): void
    {
        Cipher::resetInstance();
    }
}
