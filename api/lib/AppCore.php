<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 17/01/2016
 * Time: 21:21
 */

namespace RedChild\Api\Lib;


use RedChild\Api\Controller\BaseController;

class AppCore
{

    public function __construct($app)
    {
        $this->setupComponents($app);
        $this->setupServices($app);
        $this->setupGateways($app);
        $this->setupControllers($app);
        $this->setupRouting($app);
    }

    public function setupComponents($app)
    {
        $app['guzzle.comp'] = New \GuzzleHttp\Client([
            'timeout'=>6.0
        ]);
    }

    public function setupServices($app)
    {
        $app->register(new \Silex\Provider\MonologServiceProvider(), array(
            'monolog.logfile' => $app['logs.location'].'dev.log',
        ));

        $app->register(new \Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => $app['public_path'],
            'twig.cache' => $app['public_path'].'/tmp',
            'twig.charset' => 'utf-8',
            'twig.debug' => $app['debug']
        ));

        $app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
            'db.options' => array(
                'driver'    => 'pdo_mysql',
                'host'      => $app['db.host'],
                'dbname'    => $app['db.name'],
                'user'      => $app['db.username'],
                'password'  => $app['db.password'],
                'charset'   => $app['db.charset']
            ),
        ));
    }

    public function setupGateways($app)
    {
        // Base gateway....
        $app['base.gateway'] = $app->share(function(){
            return new \RedChild\Gateway\BaseGateway();
        });

        // Champion Model
        $app['champion.gateway'] = $app->share(function(){
            return new \RedChild\Gateway\League\ChampionGateway();
        });

        // Champion Model
        $app['game.gateway'] = $app->share(function(){
            return new \RedChild\Gateway\League\GameGateway();
        });

        // Champion Model
        $app['user.gateway'] = $app->share(function(){
            return new \RedChild\Gateway\League\UserGateway();
        });
    }

    public function setupControllers($app)
    {
        $app['base.controller'] = $app->share(function(){
            return new \RedChild\Api\Controller\BaseController();
        });

        ///League Controllers
        $app['assets.controller'] = $app->share(function(){
            return new \RedChild\Api\Controller\League\AssetsController();
        });

        $app['champion.controller'] = $app->share(function(){
            return new \RedChild\Api\Controller\League\ChampionController();
        });

        $app['game.controller'] = $app->share(function(){
            return new \RedChild\Api\Controller\League\GameController();
        });

        $app['user.controller'] = $app->share(function(){
           return new \RedChild\Api\Controller\League\UserController();
        });
    }

    public function setupRouting($app)
    {
        //Starts the shit
        $app->get('/', 'RedChild\Api\Controller\BaseController::getBase');

        //League of legends controller...

        //Assets related
        $app->get('/league/assets/fetchall/', 'RedChild\Api\Controller\League\AssetController::fetchAll');

        //Champion related
        $app->get('/league/champion/all/', 'RedChild\Api\Controller\League\ChampionController::getAllChampions');
        $app->get('/league/champion/{champion}/', 'RedChild\Api\Controller\League\ChampionController::getChampion');

        //Summoner related
        $app->get('/league/summoner/{user}/', 'RedChild\Api\Controller\League\UserController::getSummoner');
    }
}