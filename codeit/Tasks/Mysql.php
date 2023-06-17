<?php
namespace CodeIT\Tasks\Mysql;

use CodeIT\Environment;

use function \Deployer\upload;
use function \Deployer\set;
use function \Deployer\cd;
use function \Deployer\run;
use function \Deployer\writeln;

function task()
{
    writeln('Hello world');
    // /**
    //  * Try to import our database to remote
    //  */
    // try {
    //     exec('mysqldump --user=\''. $_ENV['DB_USER'] .'\' --password=\''. $_ENV['DB_PASSWORD'] .'\' '. $_ENV['DB_NAME'] .' > mysql.dump.sql');
    
    //     upload('mysql.dump.sql', '{{deploy_path}}');
    //     set('become', 'root');
    //     cd('{{deploy_path}}');
    //     run('mysql --user=\'{{db_user}}\' --password=\'{{db_password}}\' {{db_name}} < mysql.dump.sql');
    //     writeln($_ENV['DB_USER']);
    // } 
    // catch( \Exception $e ) {
    //     writeln('<fg=red;options=bold>MYSQL:</> Failed to import {{db_name}} ('. $e->getMessage() .')');
        
    //     return;
    // }

    // /**
    //  * Delete dump file from host and remote
    //  */
    // unlink('mysql.dump.sql');
    // run('rm -f mysql.dump.sql');

    // writeln('<fg=green;options=bold>MYSQL:</> Succesfully imported into {{db_name}}');
}