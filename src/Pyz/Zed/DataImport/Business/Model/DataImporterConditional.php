<?php

/**
 * Copyright © 2022-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model;

use Generated\Shared\Transfer\DataImporterReportTransfer;
use Pyz\Zed\DataImport\Business\Model\DataSet\DataSetConditionInterface;
use Spryker\Zed\DataImport\Business\Model\DataImporter;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class DataImporterConditional extends DataImporter
{
    /**
     * @var \Pyz\Zed\DataImport\Business\Model\DataSet\DataSetConditionInterface
     */
    protected $dataSetCondition;

    /**
     * @param \Pyz\Zed\DataImport\Business\Model\DataSet\DataSetConditionInterface $dataSetCondition
     *
     * @return $this
     */
    public function setDataSetCondition(DataSetConditionInterface $dataSetCondition)
    {
        $this->dataSetCondition = $dataSetCondition;

        return $this;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param \Generated\Shared\Transfer\DataImporterReportTransfer $dataImporterReportTransfer
     *
     * @return void
     */
    protected function processDataSet(DataSetInterface $dataSet, DataImporterReportTransfer $dataImporterReportTransfer): void
    {
        if ($this->dataSetCondition->hasData($dataSet)) {
            parent::processDataSet($dataSet, $dataImporterReportTransfer);
        } else {
            $dataImporterReportTransfer->setExpectedImportableDataSetCount($dataImporterReportTransfer->getExpectedImportableDataSetCount() - 1);
        }
    }
}
