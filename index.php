<?php


//Include Composer Autoloader so we can use Composer Packages in this Application
require_once __DIR__ . '/vendor/autoload.php';

//Microframeworks yo,
$app = new Silex\Application();

//Setup the config first
new RedChild\Api\Lib\AppConfig($app);

//Then run the core shit
new RedChild\Api\Lib\AppCore($app);

//Then log it's working, like durh.
$app['monolog']->addInfo('System Initialised');

//Run!
$app->run();


/**
 * Load up Silex Application for Routing.
 *
$app = new Silex\Application();
$guzzle = new GuzzleHttp\Client();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__ . '/templates',
	'twig.cache' => __DIR__ . '/cache'
));

$app['css_path'] = __DIR__ . '/../public/css';

$app['debug'] = true;

$app->get('/', function() use ($app) {	
	return $app['twig']->render('index.html.twig');
});


/**
 * Setting up Guzzle to be used to Query the LoL API
 */

/**
 * call the /api/RiotSchmick to retrieve the summoner's information from the API
 *
$app->get('/api/{username}', function($username) use ($app, $guzzle) {
  $response = $guzzle->get(API_URL . 'lol/euw/v1.4/summoner/by-name/'.$username.'?api_key=' . API_KEY);
  return $response->getBody()->getContents();
});

$app->run();*/
