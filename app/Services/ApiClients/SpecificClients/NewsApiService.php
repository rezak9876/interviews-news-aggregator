<?php
namespace App\Services\ApiClients\SpecificClients;

use App\Services\ApiClients\BaseApiClient;
use GuzzleHttp\Client;

class NewsApiService extends BaseApiClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getNews()
    {
        $response = $this->client->get('https://newsapi.org/v2/top-headlines', [
            'query' => [
                'apiKey' => env('NEWSAPI_KEY'),
                'country' => 'us'
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);
        return $response['articles'];
    }

    public function getSourceName(): string
    {
        return 'NewsApi';
    }

    public function getTitle($article): string
    {
        return $article['title'];
    }

    public function getDescription($article): string|null
    {
        return isset($article['description']) ? (string)$article['description'] : null;
    }
}
