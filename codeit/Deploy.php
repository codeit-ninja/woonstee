<?php
namespace CodeIT;

use function Deployer\{invoke, output, upload, writeLn, info, set, cd, run, test, task, after};
use Symfony\Component\Console\Helper\ProgressBar;

class Deploy
{
    public function __construct(
        private bool $provisionSite = false
    ) {}

    public function run()
    {
        if( $this->provisionSite )
        {
            set('remote_user', 'root');
            invoke('provision');
        }

        set('remote_user', $_ENV['DEV_REMOTE_USER']);
        task('deploy', [
            'deploy:prepare',
            'deploy:publish'
        ]);
        
        invoke('deploy');
    }
}