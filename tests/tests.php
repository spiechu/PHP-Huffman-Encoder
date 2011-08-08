<?php

require_once 'SplClassLoader.php';

$classLoader = new SplClassLoader('Spiechu\PHPHuffmanEncoder', '../library');
$classLoader->register();

use Spiechu\PHPHuffmanEncoder\HuffmanEncoder;

$huffman = new HuffmanEncoder();
$huffman->setString('Pisze jakis testowy tekst');
//var_dump($huffman->getBinaryTree());
var_dump($huffman->getEncodedString());
var_dump($huffman->decodeString($huffman->getEncodedString()));