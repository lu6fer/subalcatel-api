<?php

$router->get('/articles', 'ArticleController@getAll');
$router->get('/articles/{slug}', 'ArticleController@getBySlug');
$router->post('/articles', 'ArticleController@create');
$router->put('/articles/{slug}', 'ArticleController@update');
$router->delete('/articles/{slug}', 'ArticleController@delete');
$router->post('/articles/comments', 'CommentController@create');
$router->put('/articles/{slug}/comments/{id}', 'CommentController@update');
$router->delete('/articles/{slug}/comments/{id}', 'CommentController@delete');

