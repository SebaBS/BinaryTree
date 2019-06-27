<?php

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\NodeService;
use App\Service\TreeService;
use App\Service\UserService;
use DI\Container;
use DI\ContainerBuilder;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

$app = new class() extends \Slim\App {

    public function __construct()
    {
        $containerBuilder = new ContainerBuilder;
        $this->configureContainer($containerBuilder);
        $container = $containerBuilder->build();

        $this->registerServices($container);

        parent::__construct($container);
    }

    protected function configureContainer(ContainerBuilder $builder)
    {
        $config = require_once __DIR__.'/settings.php';
        $array = new \ArrayObject($config);

        $defaultServicesProvider = new \Slim\DefaultServicesProvider();
        $defaultServicesProvider->register($array);

        $builder->addDefinitions($array->getArrayCopy());
    }

    protected function registerServices(Container $container)
    {
        $container->set(EntityManager::class, function (Container $container): EntityManager {
            $config = Setup::createAnnotationMetadataConfiguration(
                $container->get('settings')['doctrine']['metadata_dirs'],
                $container->get('settings')['doctrine']['dev_mode']
            );

            $config->setMetadataDriverImpl(
                new AnnotationDriver(
                    new AnnotationReader,
                    $container->get('settings')['doctrine']['metadata_dirs']
                )
            );

            $config->setMetadataCacheImpl(
                new FilesystemCache(
                    $container->get('settings')['doctrine']['cache_dir']
                )
            );

            return EntityManager::create(
                $container->get('settings')['doctrine']['connection'],
                $config
            );
        });

        $container->set('view', function ($container) {
            $view = new \Slim\Views\Twig(__DIR__ . '/../template', [
                'cache' => __DIR__ . '/var/cache'
            ]);

            // Instantiate and add Slim specific extension
            $router = $container->get('router');
            $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
            $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

            return $view;
        });

        $container->set(NodeService::class, function (Container $container): NodeService {
            return new NodeService();
        });

        $container->set(TreeService::class, function (Container $container): TreeService {
            return new TreeService($container->get(NodeService::class));
        });

        $container->set(UserService::class, function (Container $container): UserService {
            /** @var UserRepository $userRepository */
            $userRepository = $container->get(EntityManager::class)->getRepository(User::class);
            return new UserService($container->get(EntityManager::class), $userRepository);
        });
    }
};

require_once __DIR__ . '/routes.php';

return $app;
