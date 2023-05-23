<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Persistence;

use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\PaymentTemplateConfig\Persistence\PaymentTemplateConfigPersistenceFactory getFactory()
 */
class PaymentTemplateConfigRepository extends AbstractRepository implements PaymentTemplateConfigRepositoryInterface
{
    /**
     * @var \Pyz\Zed\PaymentTemplateConfig\Persistence\Propel\Mapper\PaymentTemplateConfigMapper
     */
    protected $paymentTemplateConfigMapper;

    public function __construct()
    {
        $this->paymentTemplateConfigMapper = $this->getFactory()->createPaymentTemplateConfigMapper();
    }

    /**
     * @param string $storeReference
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer|null
     */
    public function findConfigByStoreReference(string $storeReference): ?PaymentTemplateConfigTransfer
    {
        $paymentTemplateConfigQuery = $this->getFactory()->createPaymentTemplateConfigQuery();

        $paymentTemplateConfigEntity = $paymentTemplateConfigQuery
            ->filterByStoreReference($storeReference)
            ->findOne();

        if (!$paymentTemplateConfigEntity) {
            return null;
        }

        return $this->paymentTemplateConfigMapper->mapPaymentTemplateConfigEntityToPaymentTemplateConfigTransfer(
            $paymentTemplateConfigEntity,
            new PaymentTemplateConfigTransfer(),
        );
    }
}
