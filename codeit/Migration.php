<?php
namespace CodeIT;

use function Deployer\{cd, run, output, set, get, test, upload, writeLn};
use Symfony\Component\Console\Helper\ProgressBar;

class Migration
{
    public static function run()
    {
        if( ! get('is_full_migration') ) {
            return;
        }

        set('become', $_ENV['DEV_REMOTE_USER']);
        /**
         * First run a composer install to make sure 
         * we have all the packages installed
         */
        cd('{{current_path}}');
        run('composer install', array(), null, null, null, null, true);

        /**
         * .env file is not populated, run wp env script
         */
        if( ! test( '[ -s .env ]' ) ) {
            run('wp dotenv init --template=.env.example --with-salts --force');
            run('wp dotenv set DB_NAME \'"{{db_name}}"\'', array(), null, null, null, null, true);
            run('wp dotenv set DB_USER \'"{{db_user}}"\'', array(), null, null, null, null, true);
            run('wp dotenv set DB_PASSWORD \'"{{db_password}}"\'', array(), null, null, null, null, true);
            run('wp dotenv set WP_ENV \'"production"\'');
            run('wp dotenv set WP_HOME \'"https://{{domain}}"\'', array(), null, null, null, null, true);
        }

        /**
         * Import local database into remote database
         */
        try {
            /**
             * Need to be root in order to use the mysql command later on
             */
            set('become', 'root');
            /**
             * Dump to database to a file on host
             */
            exec('mysqldump --user=\''. DB_USER .'\' --password=\''. DB_PASSWORD .'\' '. DB_NAME .' > mysql.dump.sql');
            /**
             * Upload and import the database on remote
             */
            upload('mysql.dump.sql', '{{deploy_path}}');
            cd('{{deploy_path}}');
            run('mysql --user=\'{{db_user}}\' --password=\'{{db_password}}\' {{db_name}} < mysql.dump.sql', array(), null, null, null, null, true);
            
            /**
             * Delete dump file from host and remote
             */
            unlink('mysql.dump.sql');
            run('rm -f mysql.dump.sql');

            writeln('<fg=green;options=bold>MYSQL:</> Succesfully imported into {{db_name}}');

            /**
             * Switch back to remote user to prevent conflicting permissions
             */
            set('become', $_ENV['DEV_REMOTE_USER']);
        } 
        catch( \Exception $e ) {
            writeln('<fg=red;options=bold>MYSQL:</> Failed to import database ('. $e->getMessage() .')');
            
            return;
        }

        /**
         * Migrate host upload folder to remote
         */
        $zip = new \ZipArchive();
        $zip->open('uploads.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        /** @var \SplFileInfo[] $files */
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator( WP_CONTENT_DIR . '/uploads' ),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        $progressBar = new ProgressBar( output(), count( iterator_to_array($files)) );
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s%');

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen(WP_CONTENT_DIR . '/uploads') + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
                $progressBar->advance();
            }
        }

        $progressBar->finish();
        $zip->close();

        upload('uploads.zip', '{{deploy_path}}/uploads.zip');

        run('rm -rf {{current_path}}/web/app/uploads');
        run('unzip -o {{deploy_path}}/uploads.zip -d {{current_path}}/web/app/uploads', array(), null, null, null, null, true);
        run('rm -f {{deploy_path}}/uploads.zip');
        unlink('uploads.zip');

        writeln('<fg=green;options=bold>Uploads:</> succesfully moved uploads folder to remote');
    }
}