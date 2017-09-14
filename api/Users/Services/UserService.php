<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\UserNotFoundException;
use Api\Users\Events\UserWasCreated;
use Api\Users\Events\UserWasDeleted;
use Api\Users\Events\UserWasUpdated;
use Api\Users\Repositories\UserRepository;

class UserService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $userRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        UserRepository $userRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->userRepository = $userRepository;
    }

    public function getAll($options = [])
    {
        return $this->userRepository->get($options);
    }

    /*public function getById($userId, array $options = [])
    {
        $user = $this->getRequestedUser($userId);

        return $user;
    }*/

    public function getbySlug($userSlug, $options = [])
    {
        $user = $this->userRepository->getBySlug($userSlug, $options);

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function create($data)
    {
        $user = $this->userRepository->create($data);

        $this->dispatcher->fire(new UserWasCreated($user));

        return $user;
    }

    public function update($userSlug, array $data)
    {
        $user = $this->getRequestedUser($userSlug);

        $this->userRepository->update($user, $data);

        $this->dispatcher->fire(new UserWasUpdated($user));

        return $user;
    }

    public function delete($userSlug)
    {
        $user = $this->getRequestedUser($userSlug);

        $this->userRepository->deleteWhere('slug', $userSlug);

        $this->dispatcher->fire(new UserWasDeleted($user));
    }

    private function getRequestedUser($userSlug)
    {
        $user = $this->userRepository->getBySlug($userSlug);

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}