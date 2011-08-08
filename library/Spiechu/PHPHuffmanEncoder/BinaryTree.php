<?php

namespace Spiechu\PHPHuffmanEncoder;

class BinaryTree
{

    public function getBinaryTreeFromString($string)
    {
        if ($string == '')
            throw new Exception\InvalidArgumentException('Given string has 0 length');
        $frequency = $this->countFrequency($string);
        $tempNodeHolder = $this->makeLeaves($frequency);
        $binaryTree = $this->constructTree($tempNodeHolder);
        return $binaryTree->current();
    }

    protected function countFrequency($string)
    {
        $chars = count_chars($string, 1);
        $letters = array();
        foreach ($chars as $letter => $freq)
        {
            $letters[chr($letter)] = $freq;
        }
        return $letters;
    }

    protected function makeLeaves(array $charArray)
    {
        $leaves = new TempNodeHolder();
        foreach ($charArray as $char => $freq)
        {
            $leaves->insert(new Node($freq, true, $char), $freq);
        }
        return $leaves;
    }

    protected function constructTree(TempNodeHolder $tempNodeHolder)
    {
        if ($tempNodeHolder->count() > 1)
        {
            $leftNode = $tempNodeHolder->extract();
            $rightNode = $tempNodeHolder->extract();

            $parentFrequency = $leftNode->getFrequency() + $rightNode->getFrequency();
            $parentNode = new Node($parentFrequency);
            $parentNode->addToNode($leftNode)->addToNode($rightNode);
            $tempNodeHolder->insert($parentNode, $parentNode->getFrequency());

            // recurrence until only one element in array left
            $this->constructTree($tempNodeHolder);
        }
        return $tempNodeHolder;
    }

}