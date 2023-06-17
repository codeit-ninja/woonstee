<?php
namespace Deployer;

require_once 'recipe/common.php';
require_once 'sites.php';
require_once 'website.php';
require_once 'tasks/code.php';
require_once 'tasks/dotenv.php';
require_once 'tasks/mysql.php';

/**
 * Load .env variables from file
 */
$dotenv = \Dotenv\Dotenv::createMutable( dirname( dirname( dirname( __DIR__ ) ) ) );
$dotenv->load();

add('recipes', ['codeit']);

task('codeit:provision', function() {
    if( test( '[ -d "{{deploy_path}}" ]' ) ) {
        /**
         * Site does not exist yet, so provision it first
         */
        throw new \Deployer\Exception\GracefulShutdownException($_ENV['DP_DOMAIN'] . ' is already provisioned');
    }

    // // Change user to prevent permission conflicts
    // currentHost()->set('become', 'codeit');

    // // invoke('deploy');
    // invoke('website:add');
    // invoke('website:mysql');
});

task('codeit:commit:all', [
    'codeit:commit:code',
    'codeit:commit:mysql',
    'codeit:commit:env',
]);
task('codeit:commit:code', array( Tasks\Code::class, 'run' ));
task('codeit:commit:mysql', array( Tasks\Mysql::class, 'run' ));
task('codeit:commit:env', array( Tasks\Dotenv::class, 'run' ));
task('codeit:commit:uploads', function() {});

task('website:add', array( Sites::class, 'create' ));
task('website:mysql', array( Website::class, 'mysql' ));

task('codeit:caddy', function() {
    
});

task('codeit:failed', function () {
    info('Deployment failed');
})->hidden();

// fail('codeit:verify', 'codeit:failed');

// task('provision', [
//     'provision:check',
//     'provision:configure',
//     'provision:update',
//     'provision:upgrade',
//     'provision:install',
//     'provision:ssh',
//     'provision:firewall',
//     'provision:deployer',
//     'provision:server',
//     'provision:php',
//     'provision:databases',
//     'provision:composer',
//     'provision:npm',
//     'provision:website',
//     'provision:verify',
// ]);