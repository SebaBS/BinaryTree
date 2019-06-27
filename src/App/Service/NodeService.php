<?php


namespace App\Service;


use App\DTO\NodeContentDTO;
use App\DTO\NodeDTO;

class NodeService extends AbstractService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buildNode(NodeContentDTO $nodeContent, ?NodeDTO $leftNode, ?NodeDTO $rightNode)
    {
        return new NodeDTO(
            $nodeContent->getId(),
            $nodeContent,
            $leftNode,
            $rightNode
        );
    }
}