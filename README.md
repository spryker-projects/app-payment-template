# app-payment-template
Payment Application template

[![Build Status](https://github.com/spryker-projects/app-payment-template-suite/workflows/CI/badge.svg)](https://github.com/spryker-projects/app-payment-template/actions?query=workflow%3ACI)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.1-8892BF.svg)](https://php.net/)

## Architecture

See [Spryker Docs](https://docs.spryker.com/docs/scos/dev/architecture/architecture.html).

## Installation

```bash
git clone git@github.com:spryker-projects/app-payment-template.git

cd app-payment-template

git clone https://github.com/spryker/docker-sdk.git ./docker

docker/sdk boot deploy.dev.yml # make sure to follow the on-screen instructions!
```

`docker/sdk boot` command will output the list of hosts configured for this application. You can use them to access resources on started environment.

If everything went well, you can start the environment. This might take some time.

```bash
docker/sdk up --build --assets --data
```

You should not have any other Spryker applications running at the time since there may be port conflicts between different Docker environments.

If you want to debug your application using Xdebug:

```bash
docker/sdk up -x
```

## Running tests

```bash
#Run the entire test suite
docker/sdk testing codecept run -c codeception.yml
```

## Application structure

```
|src
|-Pyz
|--Client
|---SecretsManager - configuration for secrets provider
|--Glue
|---PaymentTemplateConfigApi - private API for application configuration
|--Shared
|--Zed
|---PaymentTemplateConfig - business logic for application configuration data
```
