<?php
use Cadre\Module\ModuleLoader;
use Application\Module\AtlasOrm as AtlasOrmModule;
use Application\Module\Core as CoreModule;
use Application\Module\Domain as DomainModule;
use Application\Module\Routing as RoutingModule;
use Dotenv\Dotenv;
use Radar\Adr\Boot;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory as Request;

require '../vendor/autoload.php';

date_default_timezone_set('UTC');
define('__ROOTDIR__', realpath(__DIR__ . '/../'));

$dotenv = new Dotenv(__ROOTDIR__);
$dotenv->load();

$containerCache = null; // __DIR__ . '/../cache/container.php';

$boot = new Boot($containerCache);
$adr = $boot->adr([
    new ModuleLoader(
        [
            CoreModule::class,
            DomainModule::class,
            RoutingModule::class,
        ],
        getenv('CADRE_ENV') ?: 'development'
    ),
]);

$adr->run(Request::fromGlobals(), new Response());
