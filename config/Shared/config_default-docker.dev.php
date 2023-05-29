<?php

use Monolog\Logger;
use Pyz\Shared\Console\ConsoleConstants;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Shared\ErrorHandler\ErrorHandlerConstants;
use Spryker\Shared\ErrorHandler\ErrorRenderer\ApiDebugErrorRenderer;
use Spryker\Shared\ErrorHandler\ErrorRenderer\ApiErrorRenderer;
use Spryker\Shared\ErrorHandler\ErrorRenderer\WebExceptionErrorRenderer;
use Spryker\Shared\ErrorHandler\ErrorRenderer\WebHtmlErrorRenderer;
use Spryker\Shared\Kernel\KernelConstants;
use Spryker\Shared\Log\LogConstants;
use Spryker\Shared\Propel\PropelConstants;
use Spryker\Shared\PropelOrm\PropelOrmConstants;
use Spryker\Shared\SecretsManagerAws\SecretsManagerAwsConstants;

// ############################################################################
// ############################## DEVELOPMENT CONFIGURATION ###################
// ############################################################################

// ----------------------------------------------------------------------------
// ------------------------------ CODEBASE ------------------------------------
// ----------------------------------------------------------------------------

// >>> Debug

$config[KernelConstants::RESOLVABLE_CLASS_NAMES_CACHE_ENABLED] = false;
$config[KernelConstants::RESOLVED_INSTANCE_CACHE_ENABLED] = false;

$config[ApplicationConstants::ENABLE_APPLICATION_DEBUG]
    = (bool)getenv('SPRYKER_DEBUG_ENABLED');

$config[PropelConstants::PROPEL_DEBUG] = (bool)getenv('SPRYKER_DEBUG_PROPEL_ENABLED');

$config[KernelConstants::ENABLE_CONTAINER_OVERRIDING] = (bool)getenv('SPRYKER_TESTING_ENABLED');
$config[ConsoleConstants::ENABLE_DEVELOPMENT_CONSOLE_COMMANDS] = (bool)getenv('DEVELOPMENT_CONSOLE_COMMANDS');

// >>> Error handler

$config[ErrorHandlerConstants::DISPLAY_ERRORS] = true;
$config[ErrorHandlerConstants::ERROR_RENDERER] = getenv('SPRYKER_DEBUG_ENABLED') ? WebExceptionErrorRenderer::class : WebHtmlErrorRenderer::class;
$config[ErrorHandlerConstants::API_ERROR_RENDERER] = getenv('SPRYKER_DEBUG_ENABLED') ? ApiDebugErrorRenderer::class : ApiErrorRenderer::class;
$config[ErrorHandlerConstants::IS_PRETTY_ERROR_HANDLER_ENABLED] = (bool)getenv('SPRYKER_DEBUG_ENABLED');
$config[ErrorHandlerConstants::ERROR_LEVEL] = getenv('SPRYKER_DEBUG_DEPRECATIONS_ENABLED') ? E_ALL : $config[ErrorHandlerConstants::ERROR_LEVEL];

// ----------------------------------------------------------------------------
// ------------------------------ SERVICES ------------------------------------
// ----------------------------------------------------------------------------

$config[PropelOrmConstants::PROPEL_SHOW_EXTENDED_EXCEPTION] = true;
$config[LogConstants::LOG_LEVEL] = getenv('SPRYKER_DEBUG_ENABLED') ? Logger::INFO : Logger::DEBUG;

// >>> AWS config
$awsEndpoint = 'http://localhost.localstack.cloud:4566';
$awsAccountId = '000000000000';
$awsRegion = 'eu-central-1';
$awsAccessKeyId = 'test';
$awsAccessKeySecret = 'test';

// >>> SecretsManager AWS
$config[SecretsManagerAwsConstants::SECRETS_MANAGER_AWS_ACCESS_KEY] = $awsAccessKeyId;
$config[SecretsManagerAwsConstants::SECRETS_MANAGER_AWS_ACCESS_SECRET] = $awsAccessKeySecret;
$config[SecretsManagerAwsConstants::SECRETS_MANAGER_AWS_REGION] = $awsRegion;
$config[SecretsManagerAwsConstants::SECRETS_MANAGER_AWS_ENDPOINT] = $awsEndpoint;
