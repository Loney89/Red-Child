<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 17/01/2016
 * Time: 21:21
 */

namespace RedChild\Api\Lib;


class AppConfig
{
    public function __construct($app)
    {
        define("ROOT", __DIR__."/../../");

        $config = json_decode(file_get_contents(ROOT.'config.json'));

        date_default_timezone_set($config->application->timezone);

        $app['application_name'] = $config->application->name;
        $app['mode'] = $config->application->mode;
        $app['debug'] = $config->application->debug;

        //Database details
        $app['db.host'] = $config->database->host;
        $app['db.name'] = $config->database->name;
        $app['db.username'] = $config->database->user;
        $app['db.password'] = $config->database->password;
        $app['db.charset'] = $config->database->charaset;

        //Api
        $app['api.league.key'] = $config->api->key;
        $app['api.league.url'] = $config->api->url;

        //Logs directory
        $app['logs.location'] = ROOT.'../logs';

        //Pathing to public directory
        $app['public_path'] = ROOT.'public/';

        //Pathing to assets
        $app['css_path'] = $app['public_path'].'assets/css/';
        $app['css_thirdparty'] = $app['css_path'].'thirdparty/';
        $app['js_path'] = $app['public_path'].'assets/js/';
        $app['js_thirdparty'] = $app['js_path'].'thirdparty/';
        $app['image_path'] = $app['public_path'].'/assets/images/';
    }

}