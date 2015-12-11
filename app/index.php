<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/config.php';

date_default_timezone_set('UTC');

$app = new Silex\Application();

$app->get('/', function(){
	return new Symfony\Component\HttpFoundation\Response("Hello world");
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
