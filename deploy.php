<?php
namespace Deployer;

require '/home/codeit/.config/composer/deployer/recipe/bedrock.php';

// Config

set('repository', 'https://github.com/codeit-ninja/woonstee.git');

add('shared_files', ['.env']);
add('shared_dirs', ['web/app/uploads']);
add('writable_dirs', ['web/app/uploads']);

// Hosts

host('192.168.2.2')
    ->set('remote_user', 'codeit')
    ->set('deploy_path', '/srv/sites/dewoonsteetiel');

// Hooks

// after('deploy:failed', 'deploy:unlock');
