<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PaymentTemplateConfig\Persistence;

use Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfigQuery;
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
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer|null
     */
    public function findConfig(
        PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
    ): ?PaymentTemplateConfigTransfer {
        $paymentTemplateConfigQuery = $this->getFactory()->createPaymentTemplateConfigQuery();

        $paymentTemplateConfigQuery = $this->applyFilters(
            $paymentTemplateConfigQuery,
            $paymentTemplateConfigCriteriaTransfer,
        );

        $paymentTemplateConfigEntity = $paymentTemplateConfigQuery
            ->findOne();

        if (!$paymentTemplateConfigEntity) {
            return null;
        }

        return $this->paymentTemplateConfigMapper->mapPaymentTemplateConfigEntityToPaymentTemplateConfigTransfer(
            $paymentTemplateConfigEntity,
            new PaymentTemplateConfigTransfer(),
        );
    }

    /**
     * @param \Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfigQuery $paymentTemplateConfigQuery
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
     *
     * @return \Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfigQuery
     */
    protected function applyFilters(
        SpyPaymentTemplateConfigQuery $paymentTemplateConfigQuery,
        PaymentTemplateConfigCriteriaTransfer $paymentTemplateConfigCriteriaTransfer
    ): SpyPaymentTemplateConfigQuery {
        if ($paymentTemplateConfigCriteriaTransfer->getStoreReference()) {
            $paymentTemplateConfigQuery->filterByStoreReference($paymentTemplateConfigCriteriaTransfer->getStoreReference());
        }

        return $paymentTemplateConfigQuery;
    }
}
