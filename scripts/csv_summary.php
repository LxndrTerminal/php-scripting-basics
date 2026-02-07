<?php

$filename = readline("Enter CSV filename: ");

if (!file_exists($filename)) {
    exit("File not found.\n");
}

$data = array_map("str_getcsv", file($filename));
$headers = array_shift($data);

$columns = [];

foreach ($headers as $i => $header) {
    $columns[$header] = array_column($data, $i);
}

foreach ($columns as $name => $values) {
    echo "\n===== $name =====\n";

    if (array_filter($values, 'is_numeric') === $values) {
        $numeric = array_map('floatval', $values);

        echo "Min: " . min($numeric) . "\n";
        echo "Max: " . max($numeric) . "\n";
        echo "Avg: " . (array_sum($numeric) / count($numeric)) . "\n";
        echo "Sum: " . array_sum($numeric) . "\n";
    } else {
        $counts = array_count_values($values);
        arsort($counts);
        $common = array_key_first($counts);

        echo "Unique values: " . count($counts) . "\n";
        echo "Most common: $common\n";
    }
}