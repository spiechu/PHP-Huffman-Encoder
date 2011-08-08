<?php

namespace Spiechu\PHPHuffmanEncoder;

class Node
{
    const LEFT_MARKER = '0';
    const RIGHT_MARKER = '1';

    /**
     * @var bool 
     */
    protected $isLeaf;
    /**
     * @var string|null actual data if leave or null if parent node
     */
    protected $value;
    /**
     * @var int how frequent is $value
     */
    protected $frequency;
    /**
     * @var \Spiechu\PHPHuffmanEncoder\Node|null
     */
    protected $leftChild = null;
    /**
     * @var \Spiechu\PHPHuffmanEncoder\Node|null
     */
    protected $rightChild = null;
    /**
     * @var string possible values are 0 if node left side or 1 if right 
     */
    protected $pathMarker = '';
    /**
     * @var \Spiechu\PHPHuffmanEncoder\Node|null null when node is root 
     */
    protected $parentNode = null;

    /**
     * @param int $frequency
     * @param bool $isLeaf
     * @param string|null $value 
     */
    public function __construct($frequency, $isLeaf = false, $value = null)
    {
        $this->frequency = (int) $frequency;
        $this->isLeaf = (bool) $isLeaf;
        $this->value = $value;
    }

    /**
     * Use to attach child nodes.
     * @param \Spiechu\PHPHuffmanEncoder\Node $node child node to attach
     * @return \Spiechu\PHPHuffmanEncoder\Node self (fluent interface)
     * @throws \Spiechu\PHPHuffmanEncoder\Exception\RuntimeException when node has both child
     */
    public function addToNode(Node $node)
    {
        if ($this->leftChild == null)
        {
            $this->leftChild = $node;
            $this->leftChild->setParentNode($this);
            $this->leftChild->setPathMarker(self::LEFT_MARKER);
        } elseif ($this->rightChild == null)
        {
            $this->rightChild = $node;
            $this->rightChild->setParentNode($this);
            $this->rightChild->setPathMarker(self::RIGHT_MARKER);
        } else
        {
            throw new Exception\RuntimeException('Left and right child space occupied');
        }
        return $this;
    }

    public function setParentNode(Node $node)
    {
        $this->parentNode = $node;
        return $this;
    }

    /**
     * @return \Spiechu\PHPHuffmanEncoder\Node 
     */
    public function getParentNode()
    {
        return $this->parentNode;
    }

    /**
     * @param string $pathMarker allowed markers are 0 when left or 1 when right
     */
    public function setPathMarker($pathMarker)
    {
        $this->pathMarker = $pathMarker;
    }

    /**
     * @return string
     */
    public function getPathMarker()
    {
        return $this->pathMarker;
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int 
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @return bool 
     */
    public function isLeaf()
    {
        return $this->isLeaf;
    }

    /**
     * @return \Spiechu\PHPHuffmanEncoder\Node 
     */
    public function getLeftChild()
    {
        return $this->leftChild;
    }

    /**
     * @return \Spiechu\PHPHuffmanEncoder\Node
     */
    public function getRightChild()
    {
        return $this->rightChild;
    }

}