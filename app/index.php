<?php

/**
 * Include Composer Autoloader so we can use Composer Packages in this Application
 */
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/config.php';

/**
 * Fixes notice that newer PHP versions throw
 */
date_default_timezone_set('UTC');


/**
 * Load up Silex Application for Routing.
 */
$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/templates',
	'twig.cache' => __DIR__.'/cache'
));


$app['debug'] = true;

$app->get('/', function() use($app) {
	// we have to have use($twig) here so Twig is available in the scope of this Closure.
	return $app['twig']->render('index.html.twig');
});

$app['css_path'] = __DIR__.'/../public/css';

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
