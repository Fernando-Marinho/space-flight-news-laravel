<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use App\Repositories\EventRepository;
use App\Repositories\LaunchRepository;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ArticleService
{

    private $articleRepository;
    private $eventRepository;
    private $launchRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        EventRepository $eventRepository,
        LaunchRepository $launchRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->eventRepository = $eventRepository;
        $this->launchRepository = $launchRepository;
    }

    protected function validate($data){
        $validate = Validator::make($data, [
            'id' => 'required',
            'title' => 'required|string',
            'url' => 'required|string',
            'imageUrl' => 'required|string',
            'newsSite' => 'required|string',
            'summary' => 'string',
            'publishedAt' => 'required|string',
            'updatedAt' => 'required|string',
            'featured' => 'required|boolean',
        ]);

        return $validate->validated();
    }

    public function getArticles()
    {
        return $this->articleRepository->getArticles();
    }

    public function getArticle($id)
    {
        return $this->articleRepository->getArticle($id);
    }

    public function saveArticle($data)
    {
        try {
            
            $validatedData = $this->validate($data);

            try {
                $this->articleRepository->saveArticle($validatedData);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

            if (count($data['launches']) > 0) {
                $launches = $data['launches'];

                foreach ($launches as $key => $launch) {
                    $launch['article_id'] = $validatedData['id'];
                    $launches[$key] = $launch;

                    try {
                        $this->launchRepository->saveLaunch($launch);
                    } catch (Exception $e) {
                        throw new Exception($e->getMessage());
                    }
                }
            }

            if (count($data['events']) > 0) {
                $events = $data['events'];
                foreach ($events as $key => $event) {
                    $event['article_id'] = $validatedData['id'];
                    $events[$key] = $event;

                    try {
                        $this->eventRepository->saveEvent($event);
                    } catch (Exception $e) {
                        throw new Exception($e->getMessage());
                    }
                    
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateArticle($data, $id)
    {
        $validatedData = $this->validate($data);
        unset($validatedData['id']);

        return $this->articleRepository->updateArticle($validatedData, $id);
    }

    public function deleteArticle($id)
    {
        return $this->articleRepository->deleteArticle($id);
    }
}
