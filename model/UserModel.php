<?php

namespace RedChild\Model;

use Silex\Application;

class UserModel
{
    public function getUser($user, Application $app)
    {
        $response = $app['guzzle.comp']->get(
            $app['api.league.url'] . 'lol/euw/v1.4/summoner/by-name/'.$user.'?api_key=' . $app['api.league.key']
        );

        return $response->getBody()->getContents();
    }
}