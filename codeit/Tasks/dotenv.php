<?php
namespace Deployer\Tasks;

use function \Deployer\upload;
use function \Deployer\set;
use function \Deployer\cd;
use function \Deployer\run;
use function \Deployer\writeln;

class Dotenv
{
    public static function run()
    {
        set('become', '{{remote_user}}');
        cd('{{deploy_path}}/current');

        run('composer install', array(), null, null, null, null, true);
        run('wp dotenv init --template=.env.example --with-salts --force', array(), null, null, null, null, true);
        
        // Populate .env file
        run('wp dotenv set DB_NAME \'"{{db_name}}"\'');
        run('wp dotenv set DB_USER \'"{{db_user}}"\'');
        run('wp dotenv set DB_PASSWORD \'"{{db_password}}"\'');
        run('wp dotenv set WP_ENV \'"production"\'');
        run('wp dotenv set WP_HOME \'"https://{{domain}}"\'');
    }
}