<?php

namespace Api\Articles\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Articles\Requests\CreateCommentRequest;
use Api\Articles\Services\CommentService;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->commentService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'comments');

        return $this->response($parsedData);
    }
    

    public function create(CreateCommentRequest $request)
    {
        $data = $request->get('comment', []);

        return $this->response($this->commentService->create($data), 201);
    }

    public function update($userId, Request $request)
    {
        $data = $request->get('comment', []);

        return $this->response($this->commentService->update($userId, $data));
    }

    public function delete($userId)
    {
        return $this->response($this->commentService->delete($userId));
    }
}
