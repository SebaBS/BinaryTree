<?php


namespace App\DTO;


class NodeDTO extends AbstractDTO
{
    /**
     * @var NodeDTO|null
     */
    protected $leftChild;

    /**
     * @var NodeDTO|null
     */
    protected $rightChild;

    /**
     * @var NodeContentDTO
     */
    protected $nodeContent;

    /**
     * NodeDTO constructor.
     *
     * @param int $id
     * @param NodeContentDTO $nodeContent
     * @param NodeDTO|null $leftChild
     * @param NodeDTO|null $rightChild
     */
    public function __construct(int $id, NodeContentDTO $nodeContent, ?NodeDTO $leftChild, ?NodeDTO $rightChild)
    {
        $this->setNodeContent($nodeContent);
        $this->setLeftChild($leftChild);
        $this->setRightChild($rightChild);
        parent::__construct($id);
    }

    /**
     * @return NodeContentDTO
     */
    public function getNodeContent(): NodeContentDTO
    {
        return $this->nodeContent;
    }

    /**
     * @param NodeContentDTO $nodeContent
     */
    public function setNodeContent(NodeContentDTO $nodeContent): void
    {
        $this->nodeContent = $nodeContent;
    }

    /**
     * @return NodeDTO|null
     */
    public function getLeftChild(): ?NodeDTO
    {
        return $this->leftChild;
    }

    /**
     * @param NodeDTO|null $leftChild
     */
    public function setLeftChild(?NodeDTO $leftChild): void
    {
        $this->leftChild = $leftChild;
    }

    /**
     * @return NodeDTO|null
     */
    public function getRightChild(): ?NodeDTO
    {
        return $this->rightChild;
    }

    /**
     * @param NodeDTO|null $rightChild
     */
    public function setRightChild(?NodeDTO $rightChild): void
    {
        $this->rightChild = $rightChild;
    }

    public function toArray(): array
    {
        $parent = parent::toArray();
        return array_merge($parent, [
            'nodeContent' => $this->getNodeContent()->toArray(),
            'leftChild' => ($this->getLeftChild() ? $this->getLeftChild()->toArray() : null),
            'rightChild' => ($this->getRightChild() ? $this->getRightChild()->toArray() : null)
        ]);
    }
}