<?php

namespace RedChild\Gateway\League;

use Silex\Application;
use GuzzleHttp\Exception\BadResponseException;


class UserGateway
{
    public function getUser($user, Application $app)
    {
        try {
            $response = $app['guzzle.comp']->get(
                $app['api.league.url'] . 'euw/v1.4/summoner/by-name/' . $user . '?api_key=' . $app['api.league.key']
            );
        } catch (BadResponseException $e) {
            return array(
                'error' => 1,
                'reason' => $e->getMessage()
            );
        }

        $summoner = $response->getBody()->getContents();
        $summoner = json_decode($summoner);

        $runes = $this->getRunes($summoner->$user->id, $app);
        $masteries = $this->getMasteries($summoner->$user->id, $app);

        $result = array(
            'summoner' => $summoner->$user,
            'runes' => $runes,
            'masteries' => $masteries
        );

        return $result;
    }

    private function getRunes($id, Application $app)
    {
        try {
            $response = $app['guzzle.comp']->get(
                $app['api.league.url'] . 'euw/v1.4/summoner/' . $id . '/runes?api_key=' . $app['api.league.key']
            );
        } catch (BadResponseException $e) {
            return array(
                'error' => 1,
                'reason' => $e->getMessage()
            );
        }

        $runes = $response->getBody()->getContents();
        return json_decode($runes);
    }

    private function getMasteries($id, Application $app)
    {

        try {
            $response = $app['guzzle.comp']->get(
                $app['api.league.url'] . 'euw/v1.4/summoner/' . $id . '/masteries?api_key=' . $app['api.league.key']
            );
        } catch (BadResponseException $e) {
            return array(
                'error' => 1,
                'reason' => $e->getMessage()
            );
        }

        $masteries = $response->getBody()->getContents();
        return json_decode($masteries);

    }
}