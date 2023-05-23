<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Persistence;

use Orm\Zed\PaymentTemplateConfig\Persistence\Base\SpyPaymentTemplateConfigQuery;
use Pyz\Zed\PaymentTemplateConfig\Persistence\Propel\Mapper\PaymentTemplateConfigMapper;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigRepositoryInterface getRepository()
 * @method \Pyz\Zed\PaymentTemplateConfig\PaymentTemplateConfigConfig getConfig()
 */
class PaymentTemplateConfigPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfigQuery
     */
    public function createPaymentTemplateConfigQuery(): SpyPaymentTemplateConfigQuery
    {
        return SpyPaymentTemplateConfigQuery::create();
    }

    /**
     * @return \Pyz\Zed\PaymentTemplateConfig\Persistence\Propel\Mapper\PaymentTemplateConfigMapper
     */
    public function createPaymentTemplateConfigMapper(): PaymentTemplateConfigMapper
    {
        return new PaymentTemplateConfigMapper();
    }
}
