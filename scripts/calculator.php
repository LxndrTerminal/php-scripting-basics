<?php

if ($argc < 4) {
    echo "Usage: php calculator.php <add|sub|mul|div> <a> <b>\n";
    exit(1);
}

$op = strtolower($argv[1]);
$a = $argv[2];
$b = $argv[3];

$a = (float)$a;
$b = (float)$b;

function add(float $a, float $b): float {
    return $a + $b;
}

function sub(float $a, float $b): float{
    return $a - $b;
}

function mul(float $a, float $b): float{
    return $a * $b;
}

function div(float $a, float $b): float{
    if ($b == 0.0) {
        echo "Error: divide by zero";
        exit(1);
    }
    return $a / $b;
}

switch ($op) {
    case "add": echo add($a,$b) . "\n"; break;
    case "sub": echo sub($a,$b) . "\n"; break;
    case "mul": echo mul($a,$b) . "\n"; break;
    case "div": echo div($a,$b) . "\n"; break;
    default:
        echo "Unknown operation\n";
        exit(2);
}

echo PHP_EOL;
exit(0);