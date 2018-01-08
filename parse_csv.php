<?php

function parseCSV($path)
{
    $sum     = 0;
    $csvFile = file($path);
    foreach ($csvFile as $line) {
        $lineArray = str_getcsv($line);
        if (count($lineArray) == 3) {
            //if the row has exactly 3 collumns
            if (testColOne($lineArray[0]) && testColTwo($lineArray[1]) && testColThree($lineArray[2])) { //if all three col validations pass
                $sum = $sum + $lineArray[2]; //increment sum by col 3
            }
        }
    }
    return ($sum);

}

function testColOne($col) //regex match requirements for column 1

{

    if (preg_match('/^[a-zA-Z]{3,5}-\d+/', $col)) {
        return true;
    } else {
        return false;
    }
}

function testColTwo($col) //test that this col is an integer string therefore valid unix time

{
    return ((string) (int) $col === $col)
        && ($col <= PHP_INT_MAX)
        && ($col >= ~PHP_INT_MAX);
}

function testColThree($col) //check that his column is numeric

{
    return is_numeric($col);
}
