<?php
//after some research i found that a number,n, is a fibonacci number if (5 n^2 +4) or (5 N^2 - 4)
//is square
function isFibonacci($n)
{
    if( isSquare(5 * pow($n,2) + 4) ){ //if this test passes return true and don't do other one
        return true;
    }elseif (isSquare(5 * pow($n,2) - 4)) { //do second test
        return true;
    }else{
        return false;
    }

}

function isSquare($n)
{
    $root = sqrt($n);  //to determine if the number is square find the root and test it is a positive integer... which is surprisingly tricky
    return (is_numeric($root) && $root > 0 && $root == round($root));
}
