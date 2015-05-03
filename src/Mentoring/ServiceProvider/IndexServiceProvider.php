<?php

namespace Mentoring\ServiceProvider;

use Mentoring\Controller\IndexController;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceControllerResolver;
use Silex\ServiceProviderInterface;

class IndexServiceProvider implements ServiceProviderInterface, ControllerProviderInterface
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
            ->get('/', 'controller.index:indexAction')
            ->bind('index');

        $controllers
            ->get('/mentors', 'controller.index:mentorsAction')
            ->bind('mentors');

        $controllers
            ->get('/mentees', 'controller.index:menteesAction')
            ->bind('mentees');

        return $controllers;
    }

    public function register(Application $app)
    {
        $app['controller.index'] = $app->share(
            function ($app) {
                return new IndexController();
            }
        );
    }
}
