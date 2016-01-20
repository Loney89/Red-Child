<?php


namespace RedChild\Api\Controller;

use Silex\Application;

class AssetsController
{

    public function fetchAll(Application $app)
    {
        $app['monolog']->addInfo('Accessing the static data library from Riot....');

        $result = $app['asset.gateway']->getAssets($app);

        return $app->json(
            array (
                $result,
            ),201
        );
    }

}