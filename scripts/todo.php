<?php

$file = __DIR__ . "/todo.txt";

$action = $argv[1] ?? null;
$item = $argv[2] ?? null;

if ($action === "add" && $item)  {
    file_put_contents($file, $item . PHP_EOL, FILE_APPEND);
    echo "Added: $item\n";
    exit;
}

if ($action === "list") {
    if (!file_exists($file)) {
        echo "No items yet.\n";
        exit;
    }
    $items = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($items as $i => $x) {
        echo ($i+1) . ". $x\n";
    }
    exit;
}

if ($action === "overwrite" && $item) {
    file_put_contents($file, $item . PHP_EOL);
    exit;
}

echo "Usage:\n";
echo " php todo.php add \"Buy milk\"\n";
echo " php todo.php list\n";
echo " php todo.php overwrite \"Buy oatmilk\"\n";