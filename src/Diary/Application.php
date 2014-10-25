<?php namespace Diary;

use Silex\Application as SilexApplication;
use Silex\Application\TwigTrait;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use Whoops\Provider\Silex\WhoopsServiceProvider;

class Application extends SilexApplication
{
    use TwigTrait;

    public function __construct(array $values = array())
    {
        parent::__construct($values);
        $this->registerServices();
        $this->setUpRoutes();
    }

    public function registerServices()
    {
        $this->register(new SessionServiceProvider());
        $this->register(new WhoopsServiceProvider);
        $this->register(new TwigServiceProvider(), [
                'twig.path' => $this['base.path'] .'/views',
            ]);
    }

    public function setupRoutes()
    {
        $app['routes'] = $this->extend(
            'routes',
            function (RouteCollection $routes, Application $app) {
                $loader = new YamlFileLoader(new FileLocator($this['base.path'] . '/../app/config'));
                $collection = $loader->load('routes.yml');
                $routes->addCollection($collection);

                return $routes;
            }
        );
    }

}
