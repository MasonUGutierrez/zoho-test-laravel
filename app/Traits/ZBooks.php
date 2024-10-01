<?php

namespace App\Traits;

// use PHPUnit\TextUI\Configuration\Constant;
use Weble\ZohoClient\OAuthClient;
use Weble\ZohoClient\Enums\Region;
use Webleit\ZohoBooksApi\Client;
use Webleit\ZohoBooksApi\ZohoBooks;

// use Illuminate\Support\Facades\Cache;
use Psr\Cache\CacheItemPoolInterface;
use App\Traits\ZBooksTrait;

class ZBooks{
    use ZBooksTrait;
    
    const CONFIG = [
        'CLIENT_ID'=>'1000.6T6MRVCAOZEZBC5T1BMUTRBRVI6S7W',
        'CLIENT_SECRET' => '07eff8c19880b6db2f8d927fcd1598d48d7eebdac9',
        'ORGANIZATION_ID'=> '858282487',
        'GRANT_TOKEN'=>'1000.bed07619d3b343b6a836215ca83ec931.9b92e0df57a7166e6b514b042fe30ba4',
        'ACCESS_TOKEN'=>'1000.ffdd7923e6e7ed88908d7e0980b86af6.d6ffb80c77c06f89e458737de84f86ce',
        'REFRESH_TOKEN'=>'1000.891461171b694c6fa1fcfffb91824598.5d87e38ff515087a6d0c6f88c45d2c0d',
    
    ];

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
    public static function setUpBeforeClass(): void
    {
        $oAuthClient = self::createOAuthClient();
        $client = new Client($oAuthClient);
        $client->setOrganizationId(self::CONFIG['ORGANIZATION_ID']);

        $client = new ZohoBooks($client);

        self::$zoho = $client;
        self::$client = $client->getClient();
    }

    /**
     * Function to create a new OAuthCliente
     *
     * @return OAuthClient
     */
    protected static function createOAuthClient(): OAuthClient
    {
        $region = Region::US;

        $client = new OAuthClient(self::CONFIG['CLIENT_ID'], self::CONFIG['CLIENT_SECRET']);
        $client->setRefreshToken(self::CONFIG['REFRESH_TOKEN']);
        $client->setRegion($region);
        $client->offlineMode();
        $client->useCache(new CacheItemPoolInterface);

        return $client;
    }
}
