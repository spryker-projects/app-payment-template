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

interface PaymentTemplateConfigFacadeInterface
{
    /**
     * Specification:
     * - Looks for the store configuration using PaymentTemplateConfigTransfer.storeReference
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer|null
     */
    public function findConfig(PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer): ?PaymentTemplateConfigTransfer;

    /**
     * Specification:
     * - Saves the application configuration data into the DB.
     * - Application configuration data is encrypted.
     * - Encryption key is retrieved from external provider (AWS Secrets Manager by default).
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigResponseTransfer
     */
    public function saveConfig(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): PaymentTemplateConfigResponseTransfer;

    /**
     * Specification:
     * - Deletes the store configs from the DB by store reference.
     *
     * @param \Generated\Shared\Transfer\DisconnectParametersTransfer $disconnectParametersTransfer
     *
     * @return void
     */
    public function deleteConfigByStoreReference(DisconnectParametersTransfer $disconnectParametersTransfer): void;

    /**
     * Specification:
     * - Tests if store config exists for specified PaymentTemplateConfigCriteriaTransfer.storeReference.
     *
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return bool
     */
    public function hasConfig(PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer): bool;
}
