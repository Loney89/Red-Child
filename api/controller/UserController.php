<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 17/01/2016
 * Time: 21:23
 */

namespace RedChild\Api\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class UserController
{

    public function getUser(Request $request, Application $app)
    {

        $app['monolog']->addInfo('Added something interesting');

        $user = $request->get('user');
        $result = $app['user.model']->getUser($user, $app);

        return $result;
    }

}