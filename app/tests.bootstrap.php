<?php
$api_version = 1;

require __DIR__ . DIRECTORY_SEPARATOR . "autoload.php";

spl_autoload_register(function ($class) use ($api_version) {
    /** api version switching */
    $class = str_replace('api\\', 'api\\v' . $api_version . '\\', $class);
    $class_path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $path = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . $class_path . ".php";
    
    if (file_exists($path)) {
        require $path;
    } else {
        echo "API version $api_version is not implemented";
        die();
    }
    
});
