<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\PaymentTemplate;

interface PaymentTemplateConstants
{
    /**
     * @var string
     */
    public const APP_IDENTIFIER = 'PAYMENT_TEMPLATE:APP_IDENTIFIER';

    /**
     * Specification:
     * - Identifier of the Algolia application.
     *
     * @api
     *
     * @var string
     */
    public const APP_VERSION = 'PAYMENT_TEMPLATE:APP_VERSION';
}
