<?php

namespace App\Repositories;

use App\Models\Article;
use Exception;

class ArticleRepository
{

    public function getArticles(){
        try {
            return Article::paginate(100);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getArticle($id){
        try {
            return Article::where('id',$id)->first();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function saveArticle($data){
        try {
            Article::create($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
    }

    public function updateArticle($data, $id){
        try {
            $article = Article::where('id',$id)->first();
            if($article){
                $article->update($data);
                return $article;
            }else{
                throw new Exception("Article number ${id} not found!");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteArticle($id){
        try {
            $article = Article::where('id',$id)->first();
            if($article){
                $article->delete();
                return 'Article deleted successfully!';
            }else{
                throw new Exception("Article number ${id} not found!");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
