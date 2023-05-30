<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\PaymentTemplateConfigApi\Plugin\RouteProvider;

use Pyz\Glue\PaymentTemplateConfigApi\Controller\PaymentTemplateConfigApiController;
use Pyz\Glue\PaymentTemplateConfigApi\PaymentTemplateConfigApiConfig;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RouteProviderPluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class PaymentTemplateConfigApiRouteProviderPlugin extends AbstractPlugin implements RouteProviderPluginInterface
{
    /**
     * @param \Symfony\Component\Routing\RouteCollection $routeCollection
     *
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection->add('postSave', $this->getPostSaveConfigRoute());
        $routeCollection->add('postDisconnect', $this->getPostDisconnectRoute());

        return $routeCollection;
    }

    /**
     * @return \Symfony\Component\Routing\Route
     */
    protected function getPostSaveConfigRoute(): Route
    {
        return (new Route(PaymentTemplateConfigApiConfig::SAVE_CONFIG_ROUTE_PATH))
            ->setDefaults([
                '_controller' => [PaymentTemplateConfigApiController::class, 'postSaveAction'],
                '_resourceName' => 'paymentTemplateConfig',
            ])
            ->setMethods(Request::METHOD_POST);
    }

    /**
     * @return \Symfony\Component\Routing\Route
     */
    protected function getPostDisconnectRoute(): Route
    {
        return (new Route(PaymentTemplateConfigApiConfig::DISCONNECT_ROUTE_PATH))
            ->setDefaults([
                '_controller' => [PaymentTemplateConfigApiController::class, 'postDisconnectAction'],
                '_resourceName' => 'paymentTemplateConfig',
            ])
            ->setMethods(Request::METHOD_POST);
    }
}
