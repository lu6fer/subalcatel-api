<?php

namespace Api\Articles;

use Infrastructure\Events\EventServiceProvider;
use Api\Articles\Events\ArticleWasCreated;
use Api\Articles\Events\ArticleWasDeleted;
use Api\Articles\Events\ArticleWasUpdated;

class ArticleServiceProvider extends EventServiceProvider
{
    protected $listen = [
        ArticleWasCreated::class => [
            // listeners for when a user is created
        ],
        ArticleWasDeleted::class => [
            // listeners for when a user is deleted
        ],
        ArticleWasUpdated::class => [
            // listeners for when a user is updated
        ]
    ];
}
