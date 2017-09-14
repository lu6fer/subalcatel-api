<?php

namespace Api\Comments\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Comments\Exceptions\CommentNotFoundException;
use Api\Comments\Events\CommentWasCreated;
use Api\Comments\Events\CommentWasDeleted;
use Api\Comments\Events\CommentWasUpdated;
use Api\Comments\Repositories\CommentRepository;

class CommentService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $userRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        CommentRepository $commentRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->commentRepository = $commentRepository;
    }

    public function getAll($options = [])
    {
        return $this->commentRepository->get($options);
    }

    /*public function getById($userId, array $options = [])
    {
        $user = $this->getRequestedUser($userId);

        return $user;
    }*/

    public function getbySlug($commentSlug, $options = [])
    {
        $user = $this->commentRepository->getBySlug($commentSlug, $options);

        if (is_null($user)) {
            throw new CommentNotFoundException();
        }

        return $user;
    }

    public function create($data)
    {
        $user = $this->userRepository->create($data);

        $this->dispatcher->fire(new CommentWasCreated($user));

        return $user;
    }

    public function update($userId, array $data)
    {
        $user = $this->getRequestedUser($userId);

        $this->userRepository->update($user, $data);

        $this->dispatcher->fire(new CommentWasUpdated($user));

        return $user;
    }

    public function delete($userId)
    {
        $user = $this->getRequestedUser($userId);

        $this->userRepository->delete($userId);

        $this->dispatcher->fire(new CommentWasDeleted($user));
    }

    private function getRequestedUser($userId)
    {
        $user = $this->userRepository->getById($userId);

        if (is_null($user)) {
            throw new CommentNotFoundException();
        }

        return $user;
    }
}
