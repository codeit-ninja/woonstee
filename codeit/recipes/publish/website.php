<?php
namespace Deployer;

class Website
{
    public static function mysql()
    {
        return new Tasks\Mysql;
    }
}