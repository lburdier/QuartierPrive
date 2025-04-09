<?php

$directory = __DIR__ . '/database/migrations';
$files = glob($directory . '/*.php');

foreach ($files as $file) {
    $content = file_get_contents($file);

    // Vérifie si le fichier contient une classe
    if (!preg_match('/class\s+\w+\s+extends\s+Migration/', $content)) {
        // Génère un nom de classe basé sur le nom du fichier
        $className = 'Create' . ucfirst(basename($file, '.php'));
        $className = str_replace('_', '', ucwords($className, '_'));

        // Vérifie si le fichier utilise une classe anonyme
        if (strpos($content, 'return new class') === false) {
            // Transforme le contenu en une classe nommée
            $content = preg_replace(
                '/<\?php\s*/',
                "<?php\n\nuse Illuminate\\Database\\Migrations\\Migration;\nuse Illuminate\\Database\\Schema\\Blueprint;\nuse Illuminate\\Support\\Facades\\Schema;\n\n",
                $content
            );

            $content = "class $className extends Migration\n{\n" . $content . "\n}";
        }

        // Sauvegarde le fichier corrigé
        file_put_contents($file, $content);
        echo "Fixed: $file\n";
    }
}

echo "All migrations checked and fixed if necessary.\n";
