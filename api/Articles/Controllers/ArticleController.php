<?php

namespace Api\Articles\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Articles\Requests\CreateArticleRequest;
use Api\Articles\Services\ArticleService;

class ArticleController extends Controller
{
    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display all articles
     *
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->articleService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'articles');

        return $this->response($parsedData);
    }

    /**
     * Get article by slug
     *
     * @param $articleSlug
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function getBySlug($articleSlug)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->articleService->getBySlug($articleSlug, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'article');

        return $this->response($parsedData);
    }


    /**
     * Create new article
     *
     * @param CreateArticleRequest $request
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function create(CreateArticleRequest $request)
    {
        $data = $request->get('article', []);

        return $this->response($this->articleService->create($data), 201);
    }

    /**
     * Update article
     *
     * @param $articleSlug
     * @param Request $request
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function update($articleSlug, Request $request)
    {
        $data = $request->get('article', []);

        return $this->response($this->articleService->update($articleSlug, $data));
    }

    /**
     * Delete article
     *
     * @param $articleSlug
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function delete($articleSlug)
    {
        return $this->response($this->articleService->delete($articleSlug));
    }
}
