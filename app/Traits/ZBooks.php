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

    /**
     * Setup
     *
     * @return void
     */
    // public static function setUpBeforeClass(): void
    public function setUpBeforeClass(): void
    {
        $oAuthClient = self::createOAuthClient();

        $client = new Client($oAuthClient);
        $client->setOrganizationId(env('ORGANIZATION_ID'));
        $client = new ZohoBooks($client);

        $this->zoho = $client;
        $this->client = $client->getClient();
    }

    /**
     * Function to create a new OAuthCliente
     *
     * @return OAuthClient
     */
    protected static function createOAuthClient(): OAuthClient
    {
        $region = Region::US;

        $client = new OAuthClient(env('CLIENT_ID'), env('CLIENT_SECRET'));
        $client->setRefreshToken(env('REFRESH_TOKEN'));
        $client->setRegion($region);
        $client->offlineMode();
        
        // ToDo: Issue with interface
        $pool = new FilesystemAdapter('storage.framework.cache.data');
        $client->useCache($pool);


        return $client;
    }
}
