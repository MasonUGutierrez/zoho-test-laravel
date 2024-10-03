<?php

namespace App\Traits;

use App\Traits\ZBooksTrait;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Weble\ZohoClient\OAuthClient;
use Weble\ZohoClient\Enums\Region;
use Webleit\ZohoBooksApi\Client;
use Webleit\ZohoBooksApi\ZohoBooks;


class ZBooks{
    use ZBooksTrait;
    /**
     * @var Client
     */
    // protected static $client;
    protected $client;

    /**
     * @var ZohoBooks
     */
    // protected static $zoho;
    protected $zoho;

    private function __construct(?ZohoBooks $zoho = null)
    {
        $this->zoho = $zoho;
        $this->client = $zoho->getClient();
    }

    /**
     * Setup
     *
     * @return void
     */
    // public static function setUpBeforeClass(): void
    public static function setupClass(?array $credentials = null): static
    {
        $oAuthClient = self::createOAuthClient(isset($credentials)?$credentials:null);

        $client = new Client($oAuthClient);
        $client->setOrganizationId(
            (isset($credentials['ORGANIZATION_ID']))?$credentials['ORGANIZATION_ID']:env('ORGANIZATION_ID')
        );
        $client = new ZohoBooks($client);

        // $this->zoho = $client;
        // $this->client = $client->getClient();
        $zbook = new static($client);
        return $zbook;
    }

    /**
     * Function to create a new OAuthCliente
     *
     * @return OAuthClient
     */
    protected static function createOAuthClient(?array $credentials = null): OAuthClient
    {
        $region = Region::US;

        $client = new OAuthClient(
            (isset($credentials['CLIENT_ID']))?$credentials['CLIENT_ID']:env('CLIENT_ID'), 
            (isset($credentials['CLIENT_SECRET']))?$credentials['CLIENT_SECRET']:env('CLIENT_SECRET')
        );
        $client->setRefreshToken(
            (isset($credentials['REFRESH_TOKEN']))?$credentials['REFRESH_TOKEN']:env('REFRESH_TOKEN')
        );
        $client->setRegion($region);
        $client->offlineMode();
        
        // ToDo: Issue with interface
        $pool = new FilesystemAdapter('storage.framework.cache.data');
        $client->useCache($pool);


        return $client;
    }
}
