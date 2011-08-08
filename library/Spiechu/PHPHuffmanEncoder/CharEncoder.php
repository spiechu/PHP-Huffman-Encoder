<?php

namespace Spiechu\PHPHuffmanEncoder;

class CharEncoder
{

    public function createEncodedCharArray($string)
    {
        if ($string == '')
            throw new Exception\InvalidArgumentException('Given string has 0 length');
        $encodedCharArray = array();
        $stack = new \SplStack();
        $binaryTree = new BinaryTree();
        $stack->push($binaryTree->getBinaryTreeFromString($string));
        $currentNode = null;
        while (!$stack->isEmpty())
        {
            $currentNode = $stack->pop();
            if ($currentNode->isLeaf())
            {
                $encodedCharArray[$currentNode->getValue()] = $this->extractPath($currentNode);
            } else
            {
                if ($currentNode->getLeftChild() != null)
                {
                    $stack->push($currentNode->getLeftChild());
                }
                if ($currentNode->getRightChild() != null)
                {
                    $stack->push($currentNode->getRightChild());
                }
            }
        }
        return $encodedCharArray;
    }

    protected function extractPath(Node $node)
    {
        $path = array();
        $currentNode = $node;
        while (true)
        {
            array_unshift($path, $currentNode->getPathMarker());
            if ($currentNode->getParentNode() != null)
            {
                $currentNode = $currentNode->getParentNode();
                continue;
            } else
            {
                break;
            }
        }
        return implode('', $path);
    }

}