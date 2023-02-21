<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\ArticlesCollection;
use App\Http\Resources\ArticlesResource;
use App\Repository\ArticlesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Response;
use DB;
use App\Article;
use App\Launch;
use App\Event;

class ArticlesController extends Controller
{
     /**
	 * @var Article
	 */

     private $article;

     public function __construct(Article $article)
     {
        $this->article = $article;
     }

    //OBJETIVOS:

    //Retornar um Status: 200 e uma Mensagem "Back-end Challenge 2021 🏅 - Space Flight News"
    public function index()
    {
        $msg = "Back-end Challenge 2021 - Space Flight News";
        return response()->json($msg,200);
    }

    //   Listar todos os artigos da base de dados, utilizar o sistema de paginação para não sobrecarregar a REQUEST
    public function list(Request $request)
    {
        $article = $this->article;
	    $articlesRepository = new ArticlesRepository($article);
	    if($request->has('coditions')) {
		    $articlesRepository->selectCoditions($request->get('coditions'));
	    }
	    if($request->has('fields')) {
		    $articlesRepository->selectFilter($request->get('fields'));
	    }
	    return response()->json(new ArticlesCollection($articlesRepository->getResult()->paginate(10)));
    }

    // Obter a informação somente de um artigo
    public function show($id)
    {
        $article = Article::find($id);
	    return response()->json($article);
    }

    //Adicionar um novo artigo
    public function store(Request $request)
    {
        try{
            $newArticle = new Article();
            $newArticle->featured = $request->featured;
            $newArticle->title = $request->title;
            $newArticle->url = $request->url;
            $newArticle->imageUrl = $request->imageUrl;
            $newArticle->newsSite = $request->newsSite;
            $newArticle->summary = $request->summary;
            $newArticle->publishedAt = $request->publishedAt;
            $newArticle->launches = $request->launches;
            $newArticle->events = $request->events;

            DB::transaction(function() use ($newArticle) {
                $newArticle->save();
            });

            return response()->json($newArticle);
            
        } catch (\Exception  $errors) {
            return response()->json('Erro');
        }
    }

    // Atualizar um artigo baseado no id
    public function update(Request $request, $id)
    {
        try{
            $article = Article::find($id);
            $article->featured = $request->featured;
            $article->title = $request->title;
            $article->url = $request->url;
            $article->imageUrl = $request->imageUrl;
            $article->newsSite = $request->newsSite;
            $article->summary = $request->summary;
            $article->publishedAt = $request->publishedAt;

            if($request->launches){
                $article->launches = $request->launches;
            }
            if($request->events){
                $article->events = $request->events;
            }
            
            DB::transaction(function() use ($article) {
                $article->save();
            });
            return response()->json($article);
        
        } catch (\Exception  $errors) {
            return response()->json('Erro');
        }
    }

    //Remover um artigo baseado no id
    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();

    	return response()->json('Artigo removido');
    }
}
