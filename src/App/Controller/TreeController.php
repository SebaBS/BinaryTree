<?php

namespace App\Controller;

use App\Exception\Service\AbstractServiceException;
use App\Exception\Service\BuildTreeControllerException;
use App\Service\TreeService;
use App\Service\UserService;

class TreeController extends AbstractController
{
    /**
     * @var TreeService
     */
    protected $treeService;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * TreeController constructor.
     * @param TreeService $treeService
     * @param UserService $userService
     */
    public function __construct(TreeService $treeService, UserService $userService) {
        $this->treeService = $treeService;
        $this->userService = $userService;
    }

    public function getAll($request, $response, $args) {
        $users = $this->userService->findAllUsers();
        try {
            $rootNode = $this->treeService->buildBinaryTree($users, UserService::class, 'compareDTOs');
        } catch (AbstractServiceException $e) {
            throw new BuildTreeControllerException(null, 0, $e);
        }
        return $response;
    }

}