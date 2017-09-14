<?php

namespace Api\Articles\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Articles\Exceptions\ArticleNotFoundException;
use Api\Articles\Events\ArticleWasCreated;
use Api\Articles\Events\ArticleWasDeleted;
use Api\Articles\Events\ArticleWasUpdated;
use Api\Articles\Repositories\ArticleRepository;

class ArticleService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $articleRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        ArticleRepository $articleRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->articleRepository = $articleRepository;
    }

    public function getAll($options = [])
    {
        return $this->articleRepository->get($options);
    }


    public function getbySlug($articleSlug, $options = [])
    {
        $article = $this->articleRepository->getBySlug($articleSlug, $options);

        if (is_null($article)) {
            throw new ArticleNotFoundException();
        }

        return $article;
    }

    public function create($data)
    {
        $article = $this->articleRepository->create($data);

        $this->dispatcher->fire(new ArticleWasCreated($article));

        return $article;
    }

    public function update($articleId, array $data)
    {
        $article = $this->getRequestedArticle($articleId);

        $this->articleRepository->update($article, $data);

        $this->dispatcher->fire(new ArticleWasUpdated($article));

        return $article;
    }

    public function delete($articleId)
    {
        $article = $this->getRequestedArticle($articleId);

        $this->articleRepository->delete($articleId);

        $this->dispatcher->fire(new ArticleWasDeleted($article));
    }

    private function getRequestedArticle($articleId)
    {
        $article = $this->articleRepository->getById($articleId);

        if (is_null($article)) {
            throw new ArticleNotFoundException();
        }

        return $article;
    }
}
