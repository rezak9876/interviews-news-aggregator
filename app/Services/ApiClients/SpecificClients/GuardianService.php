<?php
namespace App\Services\ApiClients\SpecificClients;

use App\Services\ApiClients\BaseApiClient;
use GuzzleHttp\Client;

class GuardianService extends BaseApiClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getNews()
    {
        $response = $this->client->get('https://content.guardianapis.com/search', [
            'query' => [
                'api-key' => env('GUARDIAN_KEY'),
                'format' => 'json',
                'section' => 'world', // You can customize the section as needed
                'show-fields' => 'headline,thumbnail,bodyText',
                'order-by' => 'newest',
                'page-size' => 10, // Number of articles per page
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);
        return $response['response']['results'];
    }

    public function getSourceName(): string
    {
        return 'Guardian';
    }

    public function getTitle($article): string
    {
        return $article['webTitle'];
    }

    public function getDescription($article): string|null
    {
        return $article['fields']['bodyText'];
    }
}