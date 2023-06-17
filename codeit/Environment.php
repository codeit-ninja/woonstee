<?php
namespace CodeIT;

use \Dotenv\Dotenv;
use \Roots\WPConfig\Config;

class Environment
{
    protected static Environment $_instance;

    public $DB_NAME;

    public $DB_USER;

    public $DB_PASSWORD;

    public $WP_ENV;

    public $WP_HOME;

    public $WP_SITEURL;

    public $DEV_REMOTE;

    public $DEV_REMOTE_USER;

    public $DEV_SUDO_PASSWORD;

    public $DEV_DOMAIN;

    public $DEV_DEPLOY_PATH;

    public $DEV_PUBLIC_PATH;

    public $DEV_PHP_VERSION;

    
    public $DEV_DB_TYPE;
    
    public $DEV_DB_USER;
    
    public $DEV_DB_PASSWORD;
    
    public $DEV_DB_NAME;

    private function __construct()
    {
        $dotenv = Dotenv::createUnsafeMutable( dirname( __DIR__ ) );
        $dotenv->load();
        
        foreach( array_keys( (array) $this ) as $v => $k ) {
            $this->{$k} = $_ENV[$k];
        }
    }

    public static function get( string $var )
    {
        return self::load()->{$var} ?: null;
    }

    public static function load()
    {
        return self::$_instance ?? self::$_instance = new self;
    }
}