<?php

namespace RedChild\Api\Controller\League;

use Silex\Application;

class UserController
{
    public function getSummoner($user, Application $app)
    {
        $app['monolog']->addInfo('Added something interesting');

        $result = $app['user.gateway']->getUser($user, $app);

        return $app->json(
            array (
                $result,
            ),201
        );
    }

}