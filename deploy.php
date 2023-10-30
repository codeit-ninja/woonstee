<?php
namespace Deployer;

require 'recipe/common.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_valetplus_db.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_env.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_misc.php';
require 'vendor/florianmoser/bedrock-deployer/recipe/filetransfer.php';

// Config

set('repository', 'https://github.com/codeit-ninja/woonstee.git');

add('shared_files', ['.env']);
add('shared_dirs', ['web/app/uploads']);
add('writable_dirs', ['web/app/uploads']);

set( 'sync_dirs', [
    dirname( __FILE__ ) . '/web/app/uploads/' => '{{deploy_path}}/shared/web/app/uploads/',
] );

set( 'local_root', dirname( __FILE__ ) );

// Hosts

host('192.168.2.2')
    ->set('remote_user', 'codeit')
    ->set('deploy_path', '/srv/sites/dewoonsteetiel')
    ->set('release_path', '/srv/sites/dewoonsteetiel/current');

// Hooks

after('deploy:failed', 'deploy:unlock');
