# app-payment-template
Payment PBC application template

[![Build Status](https://github.com/spryker-projects/app-payment-template-suite/workflows/CI/badge.svg)](https://github.com/spryker-projects/app-payment-template/actions?query=workflow%3ACI)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.1-8892BF.svg)](https://php.net/)
[![codecov](https://codecov.io/gh/spryker-projects/app-store-suite/branch/develop/graph/badge.svg?token=JC8XS6TW16)](https://codecov.io/gh/spryker-projects/app-store-suite)


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
