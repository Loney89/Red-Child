<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 17/01/2016
 * Time: 21:24
 */

namespace RedChild\Api\Controller\League;

use Silex\Application;


class ChampionController
{
    public function getChampion($champion, Application $app)
    {
        $app['monolog']->addInfo('Looking up Champion!');

        $result = $app['champion.gateway']->getChampion($champion, $app);

        return $app->json(
            array (
                $result,
            ),201
        );
    }

    public function getAllChampions(Application $app)
    {
        $app['monolog']->addInfo('Looking up all the Champions!');

        $result = $app['champion.gateway']->getAllChampions($app);

        return $app->json(
            array (
                $result,
            ),201
        );
    }

}