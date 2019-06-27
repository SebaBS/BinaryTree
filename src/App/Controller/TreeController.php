<?php

namespace App\Controller;

use App\Exception\Service\AbstractServiceException;
use App\Service\TreeService;
use App\Service\UserService;
use DI\Container;
use Slim\Http\Request;
use Slim\Views\Twig;

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
     * @var Twig
     */
    protected $view;

    /**
     * TreeController constructor.
     * @param Container $container
     * @param TreeService $treeService
     * @param UserService $userService
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function __construct(Container $container, TreeService $treeService, UserService $userService)
    {
        $this->view = $container->get('view');
        $this->treeService = $treeService;
        $this->userService = $userService;
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function getAll($request, $response, $args)
    {
        $users = $this->userService->findAllUsers();
        try {
            $rootNode = $this->treeService->buildBinaryTree($users, UserService::class, 'compareDTOs');
            $result = $rootNode->toArray();
        } catch (AbstractServiceException $e) {
            $result = [];
        }

        return $this->view->render($response, 'index.html', [
            'rootNode' => $result,
            'users' => $users
        ]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser(Request $request, $response, $args)
    {
        $this->userService->addNewUser($request->getParsedBodyParam('username') ?? rand(0, 10000000));

        return $this->getAll($request, $response, $args);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \App\Exception\Service\UserNotFoundServiceException
     */
    public function removeUser(Request $request, $response, $args)
    {
        $this->userService->removeUser($request->getQueryParam('id') ?? 0);

        return $this->getAll($request, $response, $args);
    }

}