<?php
namespace App\Services\ApiClients;

abstract class BaseApiClient
{
    abstract public function getNews();

    abstract public function getSourceName(): string;

    abstract public function getTitle($article): string;
    
    abstract public function getDescription($article): string|null;
}
