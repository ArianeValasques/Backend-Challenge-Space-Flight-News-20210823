<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Article;

class LoadDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para popular o banco de dados com dados reebidos da API Pública';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $articles = file_get_contents("https://api.spaceflightnewsapi.net/v3/articles");
        $articles = json_decode($articles);
        $size = count($articles);

        for($i=0; $i < $size; $i++){
            $article = new Article();
            $article->featured = $articles[$i]->featured;
            $article->title = $articles[$i]->title;
            $article->url = $articles[$i]->url;
            $article->imageUrl = $articles[$i]->imageUrl;
            $article->newsSite = $articles[$i]->newsSite;
            $article->summary = $articles[$i]->summary;
            $article->publishedAt = $articles[$i]->publishedAt;
            $article->launches = json_encode($articles[$i]->launches);
            $article->events =  json_encode($articles[$i]->events);
            $article->save();
        }
    }
}
