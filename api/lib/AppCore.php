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
        $this->setupModels($app);
        $this->setupControllers($app);
        $this->setupRouting($app);
    }

    public function setupComponents($app)
    {
        $app['guzzle.comp'] = New \GuzzleHttp\Client();
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

    public function setupModels($app)
    {
        // Base model....
        $app['base.model'] = $app->share(function(){
            return new \RedChild\Model\BaseModel();
        });

        // Champion Model
        $app['champion.model'] = $app->share(function(){
            return new \RedChild\Model\ChampionModel();
        });

        // Champion Model
        $app['game.model'] = $app->share(function(){
            return new \RedChild\Model\GameModel();
        });

        // Champion Model
        $app['user.model'] = $app->share(function(){
            return new \RedChild\Model\UserModel();
        });
    }

    public function setupControllers($app)
    {
        $app['base.controller'] = $app->share(function(){
            return new \RedChild\Api\Controller\BaseController();
        });

        $app['champion.controller'] = $app->share(function(){
            return new \RedChild\Api\Controller\ChampionController();
        });

        $app['game.controller'] = $app->share(function(){
            return new \RedChild\Api\Controller\GameController();
        });

        $app['user.controller'] = $app->share(function(){
           return new \RedChild\Api\Controller\UserController();
        });
    }

    public function setupRouting($app)
    {
        //Starts the shit
        $app->get('/', 'RedChild\Api\Controller\BaseController::getBase');

        //Basic request to Riot
        $app->get('/user/{user}', 'RedChild\Api\Controller\UserController::getUser');
    }
}