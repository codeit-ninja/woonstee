<?php
namespace CodeIT;

use function Deployer\{host, task, askChoice, set, test, add, after, writeLn, run};

class Deployer
{
    public static function init() 
    {
        Environment::load();
        Deployer::hosts();
    }

    public static function hosts()
    {
        set('repository', trim(exec('git config --get remote.origin.url')));
        set('writable_recursive', true);

        add('shared_files', ['.env']);
        add('shared_dirs', [
            'web/app/uploads',
            'web/app/cache',
        ]);
        add('writable_dirs', [
            'web/app/uploads',
            'web/app/cache',
        ]);

        host('development')->setHostname( $_ENV['DEV_REMOTE'] )
            ->set('remote_user', $_ENV['DEV_REMOTE_USER'])
            ->set('domain', $_ENV['DEV_DOMAIN'])
            ->set('deploy_path', $_ENV['DEV_DEPLOY_PATH'])
            ->set('public_path', $_ENV['DEV_PUBLIC_PATH'])
            ->set('http_user', 'codeit')
            ->set('php_version', $_ENV['DEV_PHP_VERSION'] ?: 8.1)
            ->set('db_type', $_ENV['DEV_DB_TYPE'])
            ->set('db_user', $_ENV['DEV_DB_USER'])
            ->set('db_name', $_ENV['DEV_DB_NAME'])
            ->set('db_password', $_ENV['DEV_DB_PASSWORD']);
            
        host('production')->setHostname( $_ENV['PROD_REMOTE'] );

        task('codeit:deploy', function () {
            if( ! test( '[ -d "{{deploy_path}}" ]' ) ) {
                $provisionSite = askChoice('{{domain}} site does not exist, create it?', ['yes', 'no'], 0) === 'yes' ? true : false;
            }

            $fullMigration = askChoice('Run a full migration?', ['yes', 'no'], isset($provisionSite) && $provisionSite ? 0 : 1) === 'yes' ? true : false;

            set('is_full_migration', $fullMigration);

            $deploy = new Deploy( isset($provisionSite) && $provisionSite );
            $deploy->run();
        });

        task('codeit:migration', array( Migration::class, 'run' ) );

        after('deploy:failed', 'deploy:unlock');
        after('codeit:deploy', 'codeit:migration');
    }
}