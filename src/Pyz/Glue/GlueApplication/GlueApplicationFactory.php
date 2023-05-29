<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\GlueApplication;

use Spryker\Glue\GlueApplication\GlueApplicationFactory as SprykerGlueApplicationFactory;

class GlueApplicationFactory extends SprykerGlueApplicationFactory
{
    /**
     * @return array<\Spryker\Glue\GlueApplication\Validator\Request\RequestValidatorInterface>
     */
    public function createRequestValidators(): array
    {
        // AcceptedFormatValidator has been removed, since registry does not send an `Accept` header
        // @see https://spryker.atlassian.net/browse/APPS-5450
        return [];
    }
}
