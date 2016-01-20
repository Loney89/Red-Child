<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 17/01/2016
 * Time: 21:25
 */

namespace RedChild\Gateway;


class BaseGateway
{
    //Thanks riot....
    public function transformName($name)
    {
        $name = strtolower($name);
        return ucfirst($name);
    }

}