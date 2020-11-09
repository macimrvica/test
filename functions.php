<?php declare(strict_types=1);

function repeat(array $array): void
{
    $c = count($array);
    $newArray = [];

    do {
        $newArray += array_merge($array, $newArray);
    } while (--$c > 0);

    print_r($newArray);
}

repeat([1, 2, 3]);

function reformat(string $input): void
{
    echo preg_replace('/!*[aeiou]+/i', '', ucfirst(strtolower($input))) . "\n";
}

reformat("TyPEqaSt DeveLoper TeST");

function next_binary_number(array $number): string
{
    $finalSequence = [];

    $carry = 0;
    $size = sizeof($number) - 1;
    $numberToAdd = 1;

    for ($i = $size; $i >= 0; $i--) {
        //full binary adder
        $initialResult = $number[$i] ^ $numberToAdd;
        $finalResult = $carry ^ $initialResult;

        $carry = ($carry & $initialResult) | ($number[$i] & $numberToAdd);
        $finalSequence[] = $finalResult;

        //shift bits to right since im adding one only once to a number so every
        //next iteration will add 0
        $numberToAdd = $numberToAdd >> 1;
    }

    //reverse final result array
    $finalSequenceSize = sizeof($finalSequence);
    for ($i = $finalSequenceSize - 1; $i >= 0; $i--) {
        echo $finalSequence[$i];
    }

    exit;
}

next_binary_number([1, 0, 0, 0, 0, 0, 0, 0, 0, 1]);
