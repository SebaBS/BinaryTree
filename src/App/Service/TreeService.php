<?php

namespace App\Service;


use App\DTO\NodeContentDTO;
use App\DTO\NodeDTO;
use App\Exception\Service\EmptyTreeServiceException;

class TreeService extends AbstractService
{
    /**
     * @var NodeService
     */
    protected $nodeService;

    /**
     * TreeService constructor.
     * @param NodeService $nodeService
     */
    public function __construct(NodeService $nodeService)
    {
        $this->nodeService = $nodeService;
        parent::__construct();
    }

    /**
     * @param NodeContentDTO[] $content
     * @param string $elementServiceName
     * @param string $compareMethodName
     * @return NodeDTO
     * @throws EmptyTreeServiceException
     */
    public function buildBinaryTree(array $content, string $elementServiceName, string $compareMethodName): NodeDTO
    {
        usort($content, [$elementServiceName, $compareMethodName]);

        return $this->buildNodeFromContentArray($content);
    }

    /**
     * @param array $content
     * @return NodeDTO
     * @throws EmptyTreeServiceException
     */
    protected function buildNodeFromContentArray(array $content): NodeDTO
    {
        list($middleElement, $leftPart, $rightPart) = $this->extractDataParts($content);

        return $this->prepareNodeFromContent($middleElement, $leftPart, $rightPart);
    }

    /**
     * @param NodeContentDTO $middleElement
     * @param NodeContentDTO[]|null $leftPart
     * @param NodeContentDTO[]|null $rightPart
     * @return NodeDTO
     * @throws EmptyTreeServiceException
     */
    protected function prepareNodeFromContent(NodeContentDTO $middleElement, ?array $leftPart, ?array $rightPart): NodeDTO
    {
        $leftNode = $leftPart ? $this->buildNodeFromContentArray($leftPart) : null;
        $rightNode = $rightPart ? $this->buildNodeFromContentArray($rightPart) : null;

        return $this->nodeService->buildNode($middleElement, $leftNode, $rightNode);
    }

    /**
     * @param NodeContentDTO[] $content
     * @return array
     * @throws EmptyTreeServiceException
     */
    protected function extractDataParts(array $content): array
    {
        if (1 > count($content)) {
            throw new EmptyTreeServiceException();
        }

        $middleIndex = ceil(count($content) / 2) - 1;
        $middle = $content[$middleIndex];

        $leftPart = array_slice($content, 0, $middleIndex);
        if (0 == count($leftPart)) {
            $leftPart = null;
        }

        $rightPart = array_slice($content, $middleIndex + 1, count($content) - $middleIndex);
        if (0 == count($rightPart)) {
            $rightPart = null;
        }

        return [$middle, $leftPart, $rightPart];
    }
}