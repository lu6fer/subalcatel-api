<?php

namespace Api\Articles\Events;

use Infrastructure\Events\Event;
use Api\Articles\Models\Article;

class ArticleWasUpdated extends Event
{
    public $user;

    public function __construct(Article $user)
    {
        $this->user = $user;
    }
}
