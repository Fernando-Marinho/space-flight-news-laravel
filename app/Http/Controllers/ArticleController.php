<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;
use Exception;

class ArticleController extends Controller
{

    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        
        try {
            return response()->json($this->articleService->getArticles(), 200);    
        } catch (Exception $e) {
            return response()->json($e->getMessage()); 
        }
    }

    public function show($id)
    {
        try {
            return response()->json($this->articleService->getArticle($id), 200);   
        } catch (Exception $e) {
            return response()->json($e->getMessage()); 
        }
    }


    public function store(Request $request)
    {
        try {
            return response()->json($this->articleService->saveArticle($request->all()), 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage()); 
        }
           
    }


    public function update(Request $request, $id)
    {
        try {
            return response()->json($this->articleService->updateArticle($request->all(), $id), 200);   
        } catch (Exception $e) {
            return response()->json($e->getMessage());  
        }
    }

    public function destroy($id)
    {
        try {
            return response()->json($this->articleService->deleteArticle($id), 200);   
        } catch (Exception $e) {
            return response()->json($e->getMessage());  
        }
        
    }
}
