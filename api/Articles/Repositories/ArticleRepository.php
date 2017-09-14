<?php

namespace Api\Articles\Repositories;

use Api\Articles\Models\Article;
use Infrastructure\Database\Eloquent\Repository;

class ArticleRepository extends Repository
{
    public function getModel()
    {
        return new Article();
    }

    public function create($user, array $data)
    {
        $article = $this->getModel();
        $data['slug'] =
        $article->fill($data);
        $article->author()->associate($user);
        $article->save();

        return $article;
    }

    public function update(Article $article, array $data)
    {
        $article->fill($data);

        $article->save();

        return $article;
    }
}
