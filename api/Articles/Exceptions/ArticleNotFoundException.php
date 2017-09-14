<?php

namespace Api\Articles\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The article was not found.');
    }
}
