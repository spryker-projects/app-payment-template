<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Business\Saver;

use Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator\TenantPropelEncryptionConfiguratorInterface;
use Pyz\Zed\PaymentTemplateConfig\PaymentTemplateConfigConfig;
use Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigEntityManagerInterface;
use Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigRepositoryInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ConfigSaver implements ConfigSaverInterface
{
    use TransactionTrait;

    /**
     * @var \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigEntityManagerInterface
     */
    protected $paymentTemplateConfigEntityManager;

    /**
     * @var \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigRepositoryInterface
     */
    protected $paymentTemplateConfigRepository;

    /**
     * @var \Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator\TenantPropelEncryptionConfiguratorInterface
     */
    protected $tenantPropelEncryptionConfigurator;

    /**
     * @var \Pyz\Zed\PaymentTemplateConfig\PaymentTemplateConfigConfig
     */
    protected $paymentTemplateConfigConfig;

    /**
     * @param \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigEntityManagerInterface $paymentTemplateConfigEntityManager
     * @param \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigRepositoryInterface $paymentTemplateConfigRepository
     * @param \Pyz\Zed\PaymentTemplateConfig\Business\EncryptionConfigurator\TenantPropelEncryptionConfiguratorInterface $tenantPropelEncryptionConfigurator
     * @param \Pyz\Zed\PaymentTemplateConfig\PaymentTemplateConfigConfig $paymentTemplateConfigConfig
     */
    public function __construct(
        PaymentTemplateConfigEntityManagerInterface $paymentTemplateConfigEntityManager,
        PaymentTemplateConfigRepositoryInterface $paymentTemplateConfigRepository,
        TenantPropelEncryptionConfiguratorInterface $tenantPropelEncryptionConfigurator,
        PaymentTemplateConfigConfig $paymentTemplateConfigConfig
    ) {
        $this->paymentTemplateConfigEntityManager = $paymentTemplateConfigEntityManager;
        $this->paymentTemplateConfigRepository = $paymentTemplateConfigRepository;
        $this->tenantPropelEncryptionConfigurator = $tenantPropelEncryptionConfigurator;
        $this->paymentTemplateConfigConfig = $paymentTemplateConfigConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer
     */
    public function saveConfig(
        PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
    ): PaymentTemplateConfigResponseTransfer {
        $this->tenantPropelEncryptionConfigurator->configurePropelEncryption($paymentTemplateConfigTransfer->getStoreReference());

        $existedPaymentTemplateConfigTransfer = $this->paymentTemplateConfigRepository->findConfigByStoreReference(
            $paymentTemplateConfigTransfer->getStoreReference(),
        );

        if (!$existedPaymentTemplateConfigTransfer) {
            $existedPaymentTemplateConfigTransfer = new PaymentTemplateConfigTransfer();
        }

        $paymentTemplateConfigTransfer = $existedPaymentTemplateConfigTransfer->fromArray($paymentTemplateConfigTransfer->modifiedToArray(), true);

        if (!$paymentTemplateConfigTransfer->getIdPaymentTemplateConfig()) {
            $this->paymentTemplateConfigEntityManager->createConfig($paymentTemplateConfigTransfer);
        } else {
            $this->paymentTemplateConfigEntityManager->updateConfig($paymentTemplateConfigTransfer);
        }

        return (new PaymentTemplateConfigResponseTransfer())->setIsSuccessful(true);
    }
}
