<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Business\Reader;

use Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator\TenantPropelEncryptionConfiguratorInterface;
use Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigRepositoryInterface;

class ConfigReader implements ConfigReaderInterface
{
    /**
     * @var \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigRepositoryInterface
     */
    protected $paymentTemplateConfigRepository;

    /**
     * @var \Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator\TenantPropelEncryptionConfiguratorInterface
     */
    protected $tenantPropelEncryptionConfigurator;

    /**
     * @param \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigRepositoryInterface $paymentTemplateConfigRepository
     * @param \Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator\TenantPropelEncryptionConfiguratorInterface $tenantPropelEncryptionConfigurator
     */
    public function __construct(
        PaymentTemplateConfigRepositoryInterface $paymentTemplateConfigRepository,
        TenantPropelEncryptionConfiguratorInterface $tenantPropelEncryptionConfigurator
    ) {
        $this->paymentTemplateConfigRepository = $paymentTemplateConfigRepository;
        $this->tenantPropelEncryptionConfigurator = $tenantPropelEncryptionConfigurator;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer|null
     */
    public function findConfig(
        PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
    ): ?PaymentTemplateConfigTransfer {
        $this->tenantPropelEncryptionConfigurator->configurePropelEncryption(
            $paymentTemplateConfigCriteriaTransfer->getStoreReference(),
        );

        return $this->paymentTemplateConfigRepository->findConfig($paymentTemplateConfigCriteriaTransfer);
    }

    /**
     * @inheritDoc
     */
    public function hasConfig(
        PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
    ): bool {
        return $this->tenantPropelEncryptionConfigurator->withCurrentOrEmptyEncryptionKey(
            function () use ($paymentTemplateConfigCriteriaTransfer) {
                $found = $this->paymentTemplateConfigRepository->findConfig(
                    $paymentTemplateConfigCriteriaTransfer,
                );

                return $found !== null;
            },
        );
    }
}
