<?php
namespace Deployer\Tasks;

use function \Deployer\invoke;
use function \Deployer\set;

class Code
{
    public static function run()
    {
        set('become', 'codeit');
        invoke('deploy');
    }
}