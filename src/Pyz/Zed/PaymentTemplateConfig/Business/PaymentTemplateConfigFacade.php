<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Business;

use Generated\Shared\Transfer\DisconnectParametersTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\PaymentTemplateConfig\Business\PaymentTemplateConfigBusinessFactory getFactory()
 * @method \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigRepositoryInterface getRepository()
 */
class PaymentTemplateConfigFacade extends AbstractFacade implements PaymentTemplateConfigFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer|null
     */
    public function findConfig(PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer): ?PaymentTemplateConfigTransfer
    {
        return $this->getFactory()->createConfigReader()->findConfigByStoreReference($paymentTemplateConfigCriteriaTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer
     */
    public function saveConfig(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): PaymentTemplateConfigResponseTransfer
    {
        return $this->getFactory()
            ->createConfigurationSaver()
            ->saveConfig($paymentTemplateConfigTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\DisconnectParametersTransfer $disconnectParametersTransfer
     *
     * @return void
     */
    public function deleteConfigByStoreReference(DisconnectParametersTransfer $disconnectParametersTransfer): void
    {
        $this->getEntityManager()->deleteConfigByStoreReference($disconnectParametersTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return bool
     */
    public function hasConfig(PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer): bool
    {
        return $this->getFactory()->createConfigReader()->hasConfigForStoreReference($paymentTemplateConfigCriteriaTransfer->getStoreReferenceOrFail());
    }
}
