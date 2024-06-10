<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use App\Services\ApiClients\SpecificClients\GuardianService;
use App\Services\ApiClients\SpecificClients\NewsApiService;

class FetchNews extends Command
{
    protected $signature = 'fetch:news';
    protected $description = 'Fetch news articles from NewsAPI and Guardian and save to the database';

    public function handle()
    {
        $newsSources = [
            new NewsApiService(),
            new GuardianService()
        ];

        foreach ($newsSources as $source) {
            $this->storeArticleInDB($source);
        }

        $this->info('News fetched and saved successfully.');
    }

    private function storeArticleInDB($source)
    {
        $sourceName = $source->getSourceName();

        foreach ($source->getNews() as $article) {
            $title = $source->getTitle($article);
            $description = $source->getDescription($article);
            
            $existingNews = News::where('title', $title)
                ->where('description', $description)
                ->exists();

            if (!$existingNews) {
                News::create([
                    'title' => $title,
                    'description' => $description,
                    'source' => $sourceName,
                ]);
            }
        }
    }
}
