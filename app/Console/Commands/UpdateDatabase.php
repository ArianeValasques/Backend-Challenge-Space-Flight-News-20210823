<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Article;

class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualização do banco de dados, recebendo dados da API pública';

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
            $article = Article::where("title",$articles[$i]->title);
            if($article!=null){
                $newArticle = new Article();
                $newArticle->featured = $articles[$i]->featured;
                $newArticle->title = $articles[$i]->title;
                $newArticle->url = $articles[$i]->url;
                $newArticle->imageUrl = $articles[$i]->imageUrl;
                $newArticle->newsSite = $articles[$i]->newsSite;
                $newArticle->summary = $articles[$i]->summary;
                $newArticle->publishedAt = $articles[$i]->publishedAt;
                $newArticle->launches = json_encode($articles[$i]->launches);
                $newArticle->events =  json_encode($articles[$i]->events);
                $newArticle->save();
            }
        }
    }
}
