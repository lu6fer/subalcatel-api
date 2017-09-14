<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateUserRequest;
use Api\Users\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get All users
     *
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'users');

        return $this->response($parsedData);
    }

    /**
     * Get user by is slug
     *
     * @param $userSlug
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function getBySlug($userSlug)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getBySlug($userSlug, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'user');

        return $this->response($parsedData);
    }

    /**
     * Create new user
     *
     * @param CreateUserRequest $request
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function create(CreateUserRequest $request)
    {
        $data = $request->get('user', []);

        return $this->response($this->userService->create($data), 201);
    }

    /**
     * Update user
     *
     * @param $userId
     * @param Request $request
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function update($userId, Request $request)
    {
        $data = $request->get('user', []);

        return $this->response($this->userService->update($userId, $data));
    }

    /**
     * Delete user
     *
     * @param $userId
     * @return \Optimus\Bruno\Illuminate\Http\JsonResponse
     */
    public function delete($userId)
    {
        return $this->response($this->userService->delete($userId));
    }
}
