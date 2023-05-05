<?php

/**
 * Copyright © 2021-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerConfig;

use Spryker\Shared\Kernel\CodeBucket\Config\AbstractCodeBucketConfig;

class CodeBucketConfig extends AbstractCodeBucketConfig
{
    /**
     * @return array<string>
     */
    public function getCodeBuckets(): array
    {
        return [
            'DE',
            'GLOBAL',
        ];
    }

    /**
     * @deprecated This method implementation will be removed when environment configs are cleaned up.
     *
     * @return string
     */
    public function getDefaultCodeBucket(): string
    {
        return APPLICATION_STORE;
    }
}
