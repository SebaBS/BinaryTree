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

    private function getMockNodeService()
    {
        $nodeService = Mockery::mock(NodeService::class)
            ->shouldAllowMockingProtectedMethods();

        $nodeService->shouldReceive('buildNode')->andReturn(new NodeDTO(1, new UserDTO(2, 'test'), null, null));

        return $nodeService;
    }
}