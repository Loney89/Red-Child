<?php

/**
 * Include Composer Autoloader so we can use Composer Packages in this Application
 */
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/config.php';

date_default_timezone_set('UTC');

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

/**
 * Setting up Guzzle to be used to Query the LoL API
 */
$guzzle = new GuzzleHttp\Client();

/**
 * call the /api/RiotSchmick to retrieve the summoner's information from the API
 */
$app->get('/api/{username}', function($username) use ($app, $guzzle) {
  $response = $guzzle->get(API_URL . 'lol/euw/v1.4/summoner/by-name/'.$username.'?api_key=' . API_KEY);
  return $response->getBody()->getContents();
});

$app->run();
