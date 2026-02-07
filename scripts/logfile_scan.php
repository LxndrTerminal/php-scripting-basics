<?php

$filename = readline("Enter log file name: ");

if (!file_exists($filename)) {
    exit("File not found.\n");
}

$pattern = readline("Enter search term or regex: ");

$filterbydate = readline("Would you like to filter by date? Y or N: ");

$startdate = "";
$enddate = "";

if(strtolower($filterbydate) === "y") {
    $startdate = readline("Enter start date (YYYY-MM-DD) or leave blank: ");
    $enddate = readline("Enter end date (YYYY-MM-DD) or leave blank (the filter is up to and not including this date): ");
}

$matches = 0;
$errors = 0;
$info = 0;
$warn = 0;

$handle = fopen($filename, "r");
$results = fopen("results.log", "a");

while (($line = fgets($handle)) !== false) {
    if(!empty($startdate) && !str_contains($line, $startdate)){
        continue;
    }

    if (!empty($enddate) && !str_contains($line, $enddate)) {
        continue;
    }

    if (preg_match("/$pattern/i", $line)) {
        $matches++;
        if(str_contains($line, "ERROR")) {
            $errors++;
        } elseif(str_contains($line, "INFO")) {
            $info++;
        } elseif(str_contains($line, "WARN")) {
            $warn++;
        }
        fwrite($results, $line);
        echo $line;
    }
}

fclose($handle);
fclose($results);

echo "\nTotal matches: $matches\n";