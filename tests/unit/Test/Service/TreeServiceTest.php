<?php

declare(strict_types=1);


namespace Test\Service;

use App\DTO\NodeDTO;
use App\DTO\UserDTO;
use App\Exception\Service\EmptyTreeServiceException;
use App\Service\NodeService;
use App\Service\TreeService;
use App\Service\UserService;
use Mockery;
use PHPUnit\Framework\TestCase;

final class TreeServiceTest extends TestCase
{
    public function testExceptionWhileBuildingBinaryTreeWithEmptyData(): void
    {
        $this->expectException(EmptyTreeServiceException::class);

        $nodeService = $this->getMockNodeService();
        $treeService = new TreeService($nodeService);
        $treeService->buildBinaryTree([], UserService::class, 'compareUserDTOs');
    }

    public function testEvenBinaryTreeResult(): void
    {
        $treeService = new TreeService(new NodeService());

        $users = [
            new UserDTO(1, 'test1'),
            new UserDTO(2, 'test2'),
            new UserDTO(3, 'test3'),
            new UserDTO(4, 'test4'),
            new UserDTO(5, 'test5'),
            new UserDTO(6, 'test6')
        ];

        $result = $treeService->buildBinaryTree($users, UserService::class, 'compareUserDTOs');

        $this->assertSame(4, $result->getId());
        $this->assertSame(2, $result->getLeftChild()->getId());
        $this->assertSame(3, $result->getLeftChild()->getRightChild()->getId());
        $this->assertSame(1, $result->getLeftChild()->getLeftChild()->getId());
        $this->assertSame(6, $result->getRightChild()->getId());
        $this->assertSame(5, $result->getRightChild()->getLeftChild()->getId());
        $this->assertSame(null, $result->getRightChild()->getRightChild());
    }

    public function testOddBinaryTreeResult(): void
    {
        $treeService = new TreeService(new NodeService());

        $users = [
            new UserDTO(1, 'test1'),
            new UserDTO(2, 'test2'),
            new UserDTO(3, 'test3'),
            new UserDTO(4, 'test4'),
            new UserDTO(5, 'test5')
        ];

        $result = $treeService->buildBinaryTree($users, UserService::class, 'compareUserDTOs');

        $this->assertSame(3, $result->getId());
        $this->assertSame(2, $result->getLeftChild()->getId());
        $this->assertSame(null, $result->getLeftChild()->getRightChild());
        $this->assertSame(1, $result->getLeftChild()->getLeftChild()->getId());
        $this->assertSame(5, $result->getRightChild()->getId());
        $this->assertSame(4, $result->getRightChild()->getLeftChild()->getId());
        $this->assertSame(null, $result->getRightChild()->getRightChild());
    }

    public function testSingleNodeBinaryTreeResult(): void
    {
        $treeService = new TreeService(new NodeService());

        $users = [
            new UserDTO(1, 'test1')
        ];

        $result = $treeService->buildBinaryTree($users, UserService::class, 'compareUserDTOs');

        $this->assertSame(1, $result->getId());
        $this->assertSame(null, $result->getLeftChild());
        $this->assertSame(null, $result->getRightChild());
    }

    private function getMockNodeService()
    {
        $nodeService = Mockery::mock(NodeService::class)
            ->shouldAllowMockingProtectedMethods();

        $nodeService->shouldReceive('buildNode')->andReturn(new NodeDTO(1, new UserDTO(2, 'test'), null, null));

        return $nodeService;
    }
}