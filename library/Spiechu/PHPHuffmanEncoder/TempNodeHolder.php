<?php

namespace Spiechu\PHPHuffmanEncoder;

class TempNodeHolder extends \SplPriorityQueue
{

    public function compare($a, $b)
    {
        if ($a == $b)
        {
            return 0;
        }
        return ($a > $b) ? -1 : 1;
    }

}