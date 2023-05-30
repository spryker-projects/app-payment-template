<?php

/**
 * Copyright © 2021-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

use Architector\Set\ValueObject\ArchitectorSetList;
use Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\EarlyReturn\Rector\If_\ChangeAndIfToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfReturnToEarlyReturnRector;
use Rector\EarlyReturn\Rector\Return_\ReturnBinaryAndToEarlyReturnRector;
use Rector\Naming\Rector\Class_\RenamePropertyToMatchTypeRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\SetList;

defined('APPLICATION_ROOT_DIR') || define('APPLICATION_ROOT_DIR', __DIR__);

return static function (RectorConfig $rectorConfig) {
    $rectorConfig->import(ArchitectorSetList::RENAME);

    $rectorConfig->import(SetList::DEAD_CODE);
    $rectorConfig->import(SetList::EARLY_RETURN);
    $rectorConfig->import(SetList::PHP_74);

    $services = $rectorConfig->services();
    $services->set(RenamePropertyToMatchTypeRector::class);

    $rectorConfig->skip([
        ChangeAndIfToEarlyReturnRector::class,
        ChangeOrIfReturnToEarlyReturnRector::class,
        ClosureToArrowFunctionRector::class,
        RemoveUselessParamTagRector::class,
        RemoveUnusedPromotedPropertyRector::class,
        RemoveUselessReturnTagRector::class,
        ReturnBinaryAndToEarlyReturnRector::class,
        TypedPropertyRector::class,
        RenameParamToMatchTypeRector::class,
        SimplifyUselessVariableRector::class => [
            __DIR__ . '/src/Pyz/Glue/*/*DependencyProvider.php',
            __DIR__ . '/src/Pyz/Zed/*/*DependencyProvider.php',
        ],
    ]);
};
