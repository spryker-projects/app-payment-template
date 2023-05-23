<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Persistence;

use Generated\Shared\Transfer\DisconnectParametersTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfig;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

/**
 * @method \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigPersistenceFactory getFactory()
 */
class PaymentTemplateConfigEntityManager extends AbstractEntityManager implements PaymentTemplateConfigEntityManagerInterface
{
    use TransactionTrait;

    /**
     * {@inheritDoc}
     *
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function createConfig(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): PaymentTemplateConfigTransfer
    {
        return $this->saveConfig($paymentTemplateConfigTransfer, new SpyPaymentTemplateConfig());
    }

    /**
     * {@inheritDoc}
     *
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function updateConfig(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): PaymentTemplateConfigTransfer
    {
        $configEntity = $this->getFactory()
            ->createPaymentTemplateConfigQuery()
            ->findOneByStoreReference($paymentTemplateConfigTransfer->getStoreReferenceOrFail());

        return $this->saveConfig($paymentTemplateConfigTransfer, $configEntity);
    }

    /**
     * @param \Generated\Shared\Transfer\DisconnectParametersTransfer $disconnectParametersTransfer
     *
     * @return void
     */
    public function deleteConfigByStoreReference(DisconnectParametersTransfer $disconnectParametersTransfer): void
    {
         $this->getFactory()
            ->createPaymentTemplateConfigQuery()
            ->filterByStoreReference($disconnectParametersTransfer->getStoreReference())
            ->deleteAll();
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     * @param \Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfig $paymentTemplateConfigEntity
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    protected function saveConfig(
        PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer,
        SpyPaymentTemplateConfig $paymentTemplateConfigEntity
    ): PaymentTemplateConfigTransfer {
        $paymentTemplateConfigEntity = $this->getFactory()->createPaymentTemplateConfigMapper()
            ->mapPaymentTemplateConfigTransferToPaymentTemplateConfigEntity(
                $paymentTemplateConfigTransfer,
                $paymentTemplateConfigEntity,
            );

        $paymentTemplateConfigEntity->save();

        return $this->getFactory()->createPaymentTemplateConfigMapper()
            ->mapPaymentTemplateConfigEntityToPaymentTemplateConfigTransfer($paymentTemplateConfigEntity, $paymentTemplateConfigTransfer);
    }
}
