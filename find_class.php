<?php

$directory = __DIR__ . '/database/migrations';
$pattern = 'class CreatePropertiesTableUnique';
$files = glob($directory . '/*.php');

echo "Searching for '$pattern' in migration files...\n";

foreach ($files as $file) {
    $content = file_get_contents($file);
    if (strpos($content, $pattern) !== false) {
        echo "Found in: $file\n";
    }
}

echo "Search completed.\n";
