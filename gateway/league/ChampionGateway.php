<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 17/01/2016
 * Time: 21:26
 */

namespace RedChild\Gateway\League;

use Silex\Application;
use RedChild\Gateway\BaseGateway;
use GuzzleHttp\Exception\BadResponseException;

class ChampionGateway extends BaseGateway
{
    public function getChampion($champion, Application $app)
    {
        $all = $this->getAllChampions($app);
        $champion = $this->transformName($champion);

        $id = $all->$champion->id;

        try {
            $response = $app['guzzle.comp']->get(
                $app['api.league.static'] . 'euw/v1.2/champion/'.$id.'?champData=all&api_key=' . $app['api.league.key']
            );
        } catch (BadResponseException $e) {
            return array(
                'error' => 1,
                'reason' => $e->getMessage()
            );
        }

        $champion = $response->getBody()->getContents();
        $champion = json_decode($champion);

        return $champion;
    }

    public function getAllChampions(Application $app)
    {
        $app['monolog']->addInfo('Lookin em up');

        $app['monolog']->addDebug($app['api.league.static']);

        try {
            $response = $app['guzzle.comp']->get(
                $app['api.league.static'] . 'euw/v1.2/champion?api_key=' . $app['api.league.key']
            );
        } catch (BadResponseException $e) {
            return array(
                'error' => 1,
                'reason' => $e->getMessage()
            );
        }

        $champions = $response->getBody()->getContents();
        $champions = json_decode($champions);

        return $champions->data;
    }

}