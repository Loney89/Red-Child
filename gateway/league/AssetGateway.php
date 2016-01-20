<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 19/01/2016
 * Time: 23:21
 */

namespace RedChild\Gateway\League;

use Silex\Application;


class AssetGateway
{
    public function getAssets(Application $app)
    {
        /* try {
             $response = $app['guzzle.comp']->get(
                 $app['api.league.url'] . 'euw/v1.4/summoner/by-name/' . $user . '?api_key=' . $app['api.league.key']
             );
         } catch (BadResponseException $e) {
             return array(
                 'error' => 1,
                 'reason' => $e->getMessage()
             );
         }

         return $response;
        }*/
    }
}