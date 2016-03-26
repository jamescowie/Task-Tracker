<?php

namespace Snippets;

use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\ArrayCache;
use Nutwerk\Provider\DoctrineORMServiceProvider;
use Silex\Application as SilexApplication;
use Silex\Application\TwigTrait;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use Whoops\Provider\Silex\WhoopsServiceProvider;
use Silex\Provider\FormServiceProvider;

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
        $this->register(new FormServiceProvider());
        $this->register(
            new TwigServiceProvider(),
            [
                'twig.path' => $this['base.path'] . '/views',
            ]
        );
        $this->register(
            new TranslationServiceProvider(),
            array(
                'translator.messages' => array(),
            )
        );

        // database configuration
        $this->register(new \Silex\Provider\DoctrineServiceProvider(), array(
                'dbs.options' => array (
                    'mysql_read' => array(
                        'driver'    => 'pdo_mysql',
                        'host'      => 'localhost',
                        'dbname'    => 'silexdiary',
                        'user'      => 'root',
                        'password'  => '',
                        'charset'   => 'utf8',
                    ),
                    'mysql_write' => array(
                        'driver'    => 'pdo_mysql',
                        'host'      => 'localhost',
                        'dbname'    => 'silexdiary',
                        'user'      => 'root',
                        'password'  => '',
                        'charset'   => 'utf8',
                    ),
                ),
            ));

        $this->register(
            new DoctrineORMServiceProvider(),
            array(
                'db.orm.proxies_dir' => __DIR__ . '/cache/doctrine/proxy',
                'db.orm.proxies_namespace' => 'DoctrineProxy',
                'db.orm.cache' =>
                    !$this['debug'] && extension_loaded('apc') ? new ApcCache() : new ArrayCache(),
                'db.orm.auto_generate_proxies' => true,
                'db.orm.entities' => array(
                    array(
                        'type' => 'annotation',
                        'path' => __DIR__ . '/src',
                        'namespace' => 'Diary\Entities',
                    )
                ),
            )
        );
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
