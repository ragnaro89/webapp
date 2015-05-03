<?php

namespace Mentoring\ServiceProvider;

use Mentoring\Controller\ApiController;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;

class ApiServiceProvider implements ServiceProviderInterface, ControllerProviderInterface
{
    public function boot(Application $app)
    {
        // No services currently need registering
    }

    public function connect(Application $app)
    {
        /** @var \Silex\ControllerCollection; $controllers */
        $controllers = $app['controllers_factory'];
        $controllers
            ->match('/mentors', 'controller.api:getMentorsAction')
            ->method('GET')
            ->bind('api.get.mentors')
        ;

        $controllers
            ->match('/mentees', 'controller.api:getMenteesAction')
            ->method('GET')
            ->bind('api.get.mentees')
        ;

        return $controllers;
    }

    public function register(Application $app)
    {
        $app['controller.api'] = $app->share(
            function ($app) {
                return new ApiController();
            }
        );
    }
}
