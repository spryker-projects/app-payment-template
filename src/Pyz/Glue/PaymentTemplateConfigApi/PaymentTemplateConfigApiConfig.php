<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class PaymentTemplateConfigApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const SAVE_CONFIG_ROUTE_PATH = '/private/payment-template-config';

    /**
     * @var string
     */
    public const DISCONNECT_ROUTE_PATH = '/private/disconnect';

    /**
     * @var string
     */
    public const HEADER_STORE_REFERENCE = 'x-store-reference';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_MISSING_STORE_REFERENCE = 'X-Store-Reference in header is required.';

    /**
     * @var string
     */
    public const REQUEST_DATA_TYPE = 'configuration';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_BLANK_PAYMENT_API_KEY_FIELD = 'Payment API Key must not be blank.';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_NOT_STRING_PAYMENT_API_KEY_FIELD = 'Payment API Key must be a string.';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_LENGTH_PAYMENT_API_KEY_FIELD = 'Payment API Key must be 10 symbols long.';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_VALIDATION_FORMAT_ERROR_MESSAGE = 'Wrong request format.';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_DISCONNECT_ERROR = 'Disconnecting error.';
}
