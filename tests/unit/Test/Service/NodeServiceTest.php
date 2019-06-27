<?php

declare(strict_types=1);


namespace Test\Service;

use App\DTO\UserDTO;
use App\Service\NodeService;
use PHPUnit\Framework\TestCase;

final class NodeServiceTest extends TestCase
{
    public function testSuccessfulNodeBuildWithEmptyChildren(): void
    {
        $nodeService = new NodeService();
        $node = $nodeService->buildNode(new UserDTO(1, 'test1'), null, null);

        $this->assertSame(1, $node->getId());
        $this->assertSame(1, $node->getNodeContent()->getId());
        $this->assertSame(null, $node->getLeftChild());
        $this->assertSame(null, $node->getRightChild());
    }

    public function testSuccessfulNodeBuild(): void
    {
        $nodeService = new NodeService();
        $node0 = $nodeService->buildNode(new UserDTO(0, 'test0'), null, null);
        $node2 = $nodeService->buildNode(new UserDTO(2, 'test2'), null, null);

        $node1 = $nodeService->buildNode(new UserDTO(1, 'test1'), $node0, $node2);

        $this->assertSame(1, $node1->getId());
        $this->assertSame(1, $node1->getNodeContent()->getId());
        $this->assertSame(0, $node1->getLeftChild()->getId());
        $this->assertSame(2, $node1->getRightChild()->getId());
        $this->assertSame(null, $node1->getLeftChild()->getLeftChild());
        $this->assertSame(null, $node1->getLeftChild()->getRightChild());
        $this->assertSame(null, $node1->getRightChild()->getLeftChild());
        $this->assertSame(null, $node1->getRightChild()->getRightChild());
    }

}