<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\PaymentTemplateConfig\Helper;

use Codeception\Module;
use Generated\Shared\DataBuilder\DisconnectParametersBuilder;
use Generated\Shared\DataBuilder\PaymentTemplateConfigBuilder;
use Generated\Shared\Transfer\DisconnectParametersTransfer;
use Generated\Shared\Transfer\PaymentTemplateConfigTransfer;
use Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfig;
use Orm\Zed\PaymentTemplateConfig\Persistence\SpyPaymentTemplateConfigQuery;
use SprykerTest\Shared\Testify\Helper\DataCleanupHelperTrait;

class PaymentTemplateConfigHelper extends Module
{
    use DataCleanupHelperTrait;

    /**
     * @var array
     */
    public const DEFAULT_PAYMENT_TEMPLATE_CONFIG_TRANSFER_SEED = [
        'storeReference' => '6e82c297-8369-4df1-9e20-610280891620',
        'paymentApiKey' => 'payment_api_key',
    ];

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function havePaymentTemplateConfigTransfer(array $seed = []): PaymentTemplateConfigTransfer
    {
        return (new PaymentTemplateConfigBuilder($seed))->build();
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\DisconnectParametersTransfer
     */
    public function haveDisconnectParametersTransfer(array $seed = []): DisconnectParametersTransfer
    {
        return (new DisconnectParametersBuilder($seed))->build();
    }

    /**
     * @param string $storeReference
     *
     * @return void
     */
    public function addSpyPaymentTemplateConfigCleanupByStoreReference(string $storeReference): void
    {
        $dataCleanupHelper = $this->getDataCleanupHelper();

        $dataCleanupHelper->addCleanup(function () use ($storeReference): void {
            SpyPaymentTemplateConfigQuery::create()
                ->filterByStoreReference($storeReference)
                ->delete();
        });
    }

    /**
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function haveDefaultPaymentTemplateConfigTransfer(): PaymentTemplateConfigTransfer
    {
        return (new PaymentTemplateConfigTransfer())->fromArray(static::DEFAULT_PAYMENT_TEMPLATE_CONFIG_TRANSFER_SEED);
    }

    /**
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function havePersistedPaymentTemplateConfig(): PaymentTemplateConfigTransfer
    {
        $paymentTemplateConfigTransfer = $this->havePaymentTemplateConfigTransfer();

        $spyPaymentTemplateConfig = new SpyPaymentTemplateConfig();

        $spyPaymentTemplateConfig->fromArray($paymentTemplateConfigTransfer->modifiedToArray());

        $spyPaymentTemplateConfig->save();

        $spyPaymentTemplateConfig = SpyPaymentTemplateConfigQuery::create()
            ->filterByStoreReference($paymentTemplateConfigTransfer->getStoreReference())
            ->findOne();

        $dataCleanupHelper = $this->getDataCleanupHelper();

        $dataCleanupHelper->addCleanup(function () use ($spyPaymentTemplateConfig): void {
            $spyPaymentTemplateConfig->delete();
        });

        return $paymentTemplateConfigTransfer->fromArray($spyPaymentTemplateConfig->toArray(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $persistedPaymentTemplateConfigTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTemplateConfigTransfer
     */
    public function getUpdatedPaymentTemplateConfigResponseTransfer(
        PaymentTemplateConfigTransfer $persistedPaymentTemplateConfigTransfer
    ): PaymentTemplateConfigTransfer {
        $updatedPaymentTemplateConfigTransfer = new PaymentTemplateConfigTransfer();

        $updatedPaymentTemplateConfigTransfer->fromArray($persistedPaymentTemplateConfigTransfer->modifiedToArray());

        $updatedPaymentTemplateConfigTransfer->setPaymentApiKey($persistedPaymentTemplateConfigTransfer->getPaymentApiKey() . '_updated');

        return $updatedPaymentTemplateConfigTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return void
     */
    public function assertPaymentTemplateConfigIsPersisted(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): void
    {
        $storedPaymentTemplateConfigs = SpyPaymentTemplateConfigQuery::create()
            ->filterByStoreReference($paymentTemplateConfigTransfer->getStoreReference())
            ->find()
            ->toArray();

        $this->assertSame(1, count($storedPaymentTemplateConfigs), sprintf(
            'Expected to have exactly 1 persisted configuration for store reference "%s" but found "%d".',
            $paymentTemplateConfigTransfer->getStoreReference(),
            count($storedPaymentTemplateConfigs),
        ));

        $storedPaymentTemplateConfig = $storedPaymentTemplateConfigs[0];

        $this->assertEquals(
            $storedPaymentTemplateConfig['PaymentApiKey'],
            $paymentTemplateConfigTransfer->getPaymentApiKey(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $persistedPaymentTemplateConfigTransfer
     *
     * @return void
     */
    public function assertProperPaymentTemplateConfigFound(
        PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer,
        PaymentTemplateConfigTransfer $persistedPaymentTemplateConfigTransfer
    ): void {
        $this->assertEquals($paymentTemplateConfigTransfer->getIdPaymentTemplateConfig(), $persistedPaymentTemplateConfigTransfer->getIdPaymentTemplateConfig());
        $this->assertEquals($paymentTemplateConfigTransfer->getStoreReference(), $persistedPaymentTemplateConfigTransfer->getStoreReference());
        $this->assertEquals($paymentTemplateConfigTransfer->getPaymentApiKey(), $persistedPaymentTemplateConfigTransfer->getPaymentApiKey());
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer
     *
     * @return void
     */
    public function assertPaymentTemplateConfigIsNotPersisted(PaymentTemplateConfigTransfer $paymentTemplateConfigTransfer): void
    {
        $storedPaymentTemplateConfigs = SpyPaymentTemplateConfigQuery::create()
            ->filterByStoreReference($paymentTemplateConfigTransfer->getStoreReference())
            ->find()
            ->toArray();

        $this->assertSame(0, count($storedPaymentTemplateConfigs), sprintf(
            'Expected to have exactly 0 persisted configuration for store reference "%s" but found "%d".',
            $paymentTemplateConfigTransfer->getStoreReference(),
            count($storedPaymentTemplateConfigs),
        ));
    }
}
