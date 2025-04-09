<?php

$directory = __DIR__ . '/database/migrations';
$files = glob($directory . '/*.php');

foreach ($files as $file) {
    $content = file_get_contents($file);

    if (strpos($content, 'return new class') !== false) {
        $className = 'Create' . ucfirst(basename($file, '.php'));
        $className = str_replace('_', '', ucwords($className, '_'));

        $content = preg_replace(
            '/return new class extends Migration {/',
            "class $className extends Migration {",
            $content
        );

        file_put_contents($file, $content);
        echo "Fixed: $file\n";
    }
}

echo "All migrations checked and fixed if necessary.\n";
