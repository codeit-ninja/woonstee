<?php
namespace Deployer;

use CodeIT\Deployer;

require_once getcwd() . '/vendor/autoload.php';
require_once getcwd() . '/config/application.php';

require_once 'recipe/common.php';

Deployer::init();