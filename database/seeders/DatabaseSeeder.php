<?php

namespace Database\Seeders;

use App\Services\ArticleService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function run()
    {
        $count =  Http::withoutVerifying()->get('https://api.spaceflightnewsapi.net/v3/articles/count')->json();
        $articles =  Http::withoutVerifying()->get("https://api.spaceflightnewsapi.net/v3/articles?_limit=${count}")->json();
            
        foreach ($articles as $article) {
            $this->articleService->saveArticle($article);
        }
    }
}
