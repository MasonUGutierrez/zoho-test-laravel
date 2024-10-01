<?php

namespace App\Traits;

// use PHPUnit\TextUI\Configuration\Constant;
use Weble\ZohoClient\OAuthClient;
use Weble\ZohoClient\Enums\Region;
use Webleit\ZohoBooksApi\Client;
use Webleit\ZohoBooksApi\ZohoBooks;

// use Illuminate\Support\Facades\Cache;
// use Psr\Cache\CacheItemPoolInterface;
use Illuminate\Support\Facades\Cache;

use App\Traits\ZBooksTrait;

class ZBooks{
    use ZBooksTrait;
    
    // const CONFIG = [
    //     'CLIENT_ID'=>'1000.6T6MRVCAOZEZBC5T1BMUTRBRVI6S7W',
    //     'CLIENT_SECRET' => '07eff8c19880b6db2f8d927fcd1598d48d7eebdac9',
    //     'ORGANIZATION_ID'=> '858282487',
    //     'GRANT_TOKEN'=>'1000.42d86db781c0ecfa77be50b729697f45.07219f0613a37a2fc01fe6ff32df1d22',
    //     'ACCESS_TOKEN'=>'1000.7845f7d9c1b6afc3d9bf808a087d4b2f.3f73d373b6b3b02d53763f613b033d40',
    //     'REFRESH_TOKEN'=>'1000.891461171b694c6fa1fcfffb91824598.5d87e38ff515087a6d0c6f88c45d2c0d',
    
    // ];

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
        // $client->setOrganizationId(self::CONFIG['ORGANIZATION_ID']);
        // var_dump($client);
        $client->setOrganizationId(env('ORGANIZATION_ID'));

        // echo "<hr>";
        $client = new ZohoBooks($client);
        // var_dump($client);

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

        // $client = new OAuthClient(self::CONFIG['CLIENT_ID'], self::CONFIG['CLIENT_SECRET']);
        // $client->setRefreshToken(self::CONFIG['REFRESH_TOKEN']);
        $client = new OAuthClient(env('CLIENT_ID'), env('CLIENT_SECRET'));
        $client->setRefreshToken(env('REFRESH_TOKEN'));
        $client->setRegion($region);
        $client->offlineMode();
        
        // ToDo: Issue with interface
        // $client->useCache(new CacheItemPoolInterface);
        // $client->useCache(cache::store('file'));

        return $client;
    }
}
