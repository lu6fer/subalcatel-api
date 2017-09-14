<?php

namespace Api\Articles\Controllers\Admin;

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

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->articleService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'users');

        return $this->response($parsedData);
    }

    public function getById($userId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->articleService->getById($userId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'user');

        return $this->response($parsedData);
    }

    public function create(CreateArticleRequest $request)
    {
        $data = $request->get('user', []);

        return $this->response($this->articleService->create($data), 201);
    }

    public function update($userId, Request $request)
    {
        $data = $request->get('user', []);

        return $this->response($this->articleService->update($userId, $data));
    }

    public function delete($userId)
    {
        return $this->response($this->articleService->delete($userId));
    }
}
