<?php

namespace Spiechu\PHPHuffmanEncoder;

class HuffmanEncoder
{

    /**
     * @var string 
     */
    protected $stringToEncode = '';
    /**
     * @var \Spiechu\PHPHuffmanEncoder\Node 
     */
    protected $binaryTree = null;
    protected $encodedCharArray = array();

    public function setString($string)
    {
        $this->stringToEncode = $string;
    }

    public function getEncodedCharArray()
    {
        if ($this->encodedCharArray == null)
        {
            $charEncoder = new CharEncoder();
            $this->encodedCharArray = $charEncoder->createEncodedCharArray($this->stringToEncode);
        }
        return $this->encodedCharArray;
    }

    public function getBinaryTree()
    {
        if ($this->binaryTree == null)
        {
            $binaryTree = new BinaryTree();
            $this->binaryTree = $binaryTree->getBinaryTreeFromString($this->stringToEncode);
        }
        return $this->binaryTree;
    }

    public function getEncodedString()
    {
        $encodedString = '';
        foreach (str_split($this->stringToEncode) as $key => $value)
        {
            $encCharArray = $this->getEncodedCharArray();
            $encodedString .= $encCharArray[$value];
        }
        return $encodedString;
    }

    public function decodeString($string)
    {
        $encodedStringArray = array_flip($this->getEncodedCharArray());
        $decodedString = '';
        $splittedString = str_split($string);
        $partialCode = '';
        while (count($splittedString) > 0)
        {
            $partialCode .= array_shift($splittedString);
            if (array_key_exists($partialCode, $encodedStringArray))
            {
                $decodedString .= $encodedStringArray[$partialCode];
                $partialCode = '';
            }
        }
        return $decodedString;
    }

}