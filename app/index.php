<?php

/**
 * Include Composer Autoloader so we can use Composer Packages in this Application
 */
require_once __DIR__.'/../vendor/autoload.php';

/**
 * Fixes notice that newer PHP versions throw
 */
date_default_timezone_set('UTC');

/**
 * Load up Twig so we can build templates and render them
 * http://twig.sensiolabs.org/doc/api.html
 */
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, array(
    'cache' => __DIR__.'/cache',
));

/**
 * Load up Silex Application for Routing.
 */
$app = new Silex\Application();

$app->get('/', function() use($twig) {
	// we have to have use($twig) here so Twig is available in the scope of this Closure.
	return $twig->loadTemplate('index.html.twig')->render(['name' => 'simon']);
});

$app->run();
