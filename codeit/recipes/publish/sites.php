<?php
namespace Deployer;

class Sites 
{
    public array $sites_enabled;

    public array $sites_disabled;

    private function __construct()
    {
        if( test('[ ! -f "/srv/sites/sites-enabled.conf" ]') ) {
            run('touch /srv/sites/sites-enabled.conf');
        }

        $sites = run('cat /srv/sites/sites-enabled.conf');
        
        $this->sites_enabled = array_filter(explode(PHP_EOL, $sites), fn( string $site ) => ! str_starts_with( $site, '#' ));
        $this->sites_disabled = array_map(fn($site) => str_replace('# ', '', $site), 
            array_filter(explode(PHP_EOL, $sites), fn( string $site ) => str_starts_with( $site, '#' ))
        );
    }

    public function add( string $site )
    {
        if( $this->site_exists( $this->sites_enabled, $site ) ) {
            return;
        }

        if( $this->site_exists( $this->sites_disabled, $site ) ) {
            $this->change_status( $this->site_exists( $this->sites_disabled, $site ), $this->sites_disabled, $this->sites_enabled );
            
            return $this->reload();
        }

        array_push( $this->sites_enabled, 'import ' . $site . '/Caddyfile' );

        return $this->reload();
    }

    public function site_exists( array &$in_status, string $site ) 
    {
        $pattern = '/'. preg_quote($site, '/') .'/';
        $site_match = preg_grep($pattern, $in_status );

        if( $site_match ) {
            return key( $site_match );
        }
    }

    public function change_status( int $site, array &$old_status, array &$new_status )
    {
        array_push($new_status, $old_status[$site]);
        unset( $old_status[$site] );
    }

    public function enable( string $site )
    {
        $this->change_status( 
            $this->site_exists( $this->sites_enabled, $site ), 
            $this->sites_enabled, 
            $this->sites_disabled 
        );
    }

    public function disable( string $site )
    {
        $this->change_status( 
            $this->site_exists( $this->sites_disabled, $site ), 
            $this->sites_disabled,
            $this->sites_enabled 
        );
    }

    private function reload()
    {
        run('echo "'. join(PHP_EOL, array_merge($this->sites_enabled, $this->sites_disabled)) .'" > /srv/sites/sites-enabled.conf');
        
        cd('/srv/sites');
        run('caddy reload');

        info('Caddy config reloaded');
    }

    public static function create()
    {
        (new Sites)->add( get('deploy_path') );
    }
}