<?php

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\Model\Manager as ModelsManager;



define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();
$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/forms/',
        
    ]
)->register();

// Create a DI
$di = new FactoryDefault();

// Setting up the view component
$di['view'] = function () {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');
    return $view;
};

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di['url'] = function () {
    $url = new UrlProvider();
    $url->setBaseUri('/ovo/');
    return $url;
};

// Set the database service
$di['db'] = function () {
    return new DbAdapter([
        "host"     => 'localhost',
        "username" => 'root',
        "password" => '',
        "dbname"   => "ovo",
    ]);
};

$di['session']= function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
};

// Set up the flash service
$di['flash']= function () {
    return new FlashSession(
        [
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning',
        ]
    );
};

$di['modelsManager'] = function() {
    return new ModelsManager();
};



// Handle the request
try {
    $application = new Application($di);
    echo $application->handle()->getContent();
} catch (Exception $e) {
    echo "Exception: ", $e->getMessage();
}
