<?php
namespace Deployer;

require '/home/codeit/.config/composer/deployer/recipe/bedrock.php';

// Config

set('repository', 'https://github.com/codeit-ninja/woonstee.git');

add('shared_files', ['.env']);
add('shared_dirs', ['web/app/uploads']);
add('writable_dirs', ['web/app/uploads']);

// Hosts

host('staging')
    ->set('hostname', 'dewoonsteetiel.codeit.website')
    ->set('remote_user', 'codeit-dewoonsteetiel')
    ->set('deploy_path', '/home/codeit-dewoonsteetiel/htdocs');

host('production')
    ->set('hostname', '185.208.207.112')
    ->set('remote_user', 'codeit')
    ->set('deploy_path', '/srv/dewoonsteetiel.nl');

// Hooks
after('deploy:failed', 'deploy:unlock');
