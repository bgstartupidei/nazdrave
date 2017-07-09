<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

date_default_timezone_set('Europe/Sofia');
require __DIR__ . '/../vendor/autoload.php';

// FIXME
function __($text) {
    return $text;
}

define('BASE_DIR', realpath(__DIR__ . '/../'));

// Instantiate the app
$settings = require BASE_DIR . '/settings/settings.php';

$app = new \Slim\App($settings);

$app->add(new \Slim\Middleware\Session([
    'name' => 'ssn',
    'autorefresh' => true,
    'lifetime' => '3 months',
]));

// Container
$container = $app->getContainer();

$container['validation'] = function($c) {
    return new \Sirius\Validation\Validator;
};

// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

$sessionHandler = new Nazdrave\Utils\DbSessionHandler($container);
session_set_save_handler($sessionHandler, true);

// Session middleware
$container['session'] = function ($c) {
    return new \SlimSession\Helper;
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig($container['settings']['renderer']['template_path'], [
        'cache' => false, //__DIR__ . '/../cache/twig/'
    ]);

    $filter = new Twig_SimpleFilter('gmdate', function ($seconds) {
        return gmdate("H:i:s", $seconds);
    });
    $view->getEnvironment()->addFilter($filter);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new \Cocur\Slugify\Bridge\Twig\SlugifyExtension(\Cocur\Slugify\Slugify::create()));
    return $view;
};

// Register controllers
$container['HomeController'] = function ($container) {
    return new \Nazdrave\Controller\HomeController($container);
};
$container['AuthController'] = function ($container) {
    return new \Nazdrave\Controller\AuthController($container);
};

$authMiddleware = function($request, $response, $next) {
    if ($request->isPost()) {
        if ($request->getParam('name')) {
            return $response->withStatus(501);
        }
    }
    return $next($request, $response);
};

// Home
$app->get('/', 'HomeController:index');
$app->get('/sitemap', 'HomeController:sitemap');

// Auth
$app->map(['GET', 'POST'], '/auth/login', 'AuthController:login')->add($authMiddleware);
$app->map(['GET', 'POST'], '/auth/register', 'AuthController:register')->add($authMiddleware);
$app->get('/auth/logout', 'AuthController:logout');


// Run app
$app->run();
