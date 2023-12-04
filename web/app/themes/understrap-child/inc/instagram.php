<?php

use GuzzleHttp\Exception\GuzzleException;
use Instagram\Api;
use Instagram\Exception\InstagramAuthException;
use Instagram\Exception\InstagramException;
use Instagram\Model\Profile;
use Instagram\Utils\MediaDownloadHelper;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

trait InstagramTrait
{
    /**
     * @throws InstagramAuthException
     * @throws GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public static function api(): Api
    {
        $api = new Api( new FilesystemAdapter( 'Instagram', 0, static::$cache_dir ) );
        $api->login( env( 'INSTAGRAM_USERNAME' ), env( 'INSTAGRAM_PASSWORD' ) );

        return $api;
    }

    /**
     * @throws InstagramAuthException
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws InstagramException
     * @throws GuzzleException
     */
    public static function get_profile(): Profile
    {
        return self::api()->getProfile( env( 'INSTAGRAM_PROFILE' ) );
    }
}

class WP_Instagram
{
    use InstagramTrait;

    public static Api $api;

    public static string $cache_dir = WP_CONTENT_DIR . '/cache';

    public static function register_rest_route(): void
    {
        register_rest_route( 'api/v1', '/instagram/profile', array( 
            'methods' => 'GET', 
            'callback' => array( static::class, 'fetch_profile' ),
            'permission_callback' => '__return_true',
        ) );

        register_rest_route( 'api/v1', '/instagram/posts', array(
            'methods' => 'GET',
            'callback' => array( static::class, 'get_latest_posts' ),
            'permission_callback' => '__return_true',
        ) );

        register_rest_route( 'api/v1', '/instagram/import', array(
            'methods' => 'GET',
            'callback' => array( static::class, 'import_latest_posts' ),
            'permission_callback' => '__return_true',
        ) );
    }

    public static function validate(): ?WP_Error
    {
        if( env( 'INSTAGRAM_USERNAME' ) && env( 'INSTAGRAM_PASSWORD' ) && env( 'INSTAGRAM_PROFILE' ) ) 
        {
            return null;
        }

        $data = [
            'username'  => env( 'INSTAGRAM_USERNAME' ),
            'profile'   => env( 'INSTAGRAM_PROFILE' ),
            'password'  => !! env( 'INSTAGRAM_PASSWORD' ),
        ];
        
        return new WP_Error( 401, 'Login details missing', $data );
    }

    public static function fetch_profile(): WP_Error|array
    {
        if( static::validate() instanceof WP_Error ) 
        {
            return static::validate();
        }

        try
        {
            return static::get_profile()->toArray();
        }
        catch( GuzzleException|\Psr\Cache\InvalidArgumentException|InstagramAuthException|InstagramException $e )
        {
            return new WP_Error( 504, $e->getMessage() );
        }
    }

    /**
     * Recommended to call only from a cronjob call
     * Calling this function many times makes server using lots of resources
     * to fetch and download images.
     */
    public static function import_latest_posts(): WP_Error|array
    {
        if( static::validate() instanceof WP_Error )
        {
            return static::validate();
        }

        try
        {
            $medias = static::get_profile()->getMedias();
            $upload_dir = wp_get_upload_dir()['basedir'] . '/instagram';
            $json = array();

            wp_mkdir_p( $upload_dir );

            /**
             * Remove previous imported data
             * Don't remove, this or server will get 1000's of images in the long run
             *
             * This way we're saving lots of disk space
             */
            foreach(glob($upload_dir . '/*') as $file) {
                @unlink($file);
            }

            foreach ( $medias as $media )
            {
                $filename = MediaDownloadHelper::downloadMedia($media->getThumbnailSrc(), $upload_dir);
                $json[] = array( ...$media->toArray(), 'filename' => $filename );
            }

            file_put_contents( $upload_dir . '/medias.json', json_encode( $json ) );

            return json_decode( file_get_contents( $upload_dir . '/medias.json' ) );
        }
        catch( GuzzleException|\Psr\Cache\InvalidArgumentException|InstagramAuthException|InstagramException $e )
        {
            return new WP_Error( 504, $e->getMessage() );
        }
    }

    public static function get_latest_posts(): WP_Error|array
    {
        $pathToInstagram = wp_get_upload_dir()['basedir'] . '/instagram';
        $instagramJson = $pathToInstagram . '/medias.json';

        /**
         * Trigger an import when data does not exist yet
         * The next time this file should exist to prevent server overload
         */
        if( ! file_exists( $instagramJson ) )
        {
            return static::import_latest_posts();
        }

        return json_decode( file_get_contents( $instagramJson ) );
    }
}