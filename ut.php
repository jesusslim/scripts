<?php

function run($dir, $className, $funcName)
{
    if (@$handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false) {
            if ($file != ".." && $file != ".") {
                if (is_dir($dir . '/' . $file)) {
                    run($dir . '/' . $file, $className, $funcName);
                } else {
                    $fullPath = $dir . '/' . $file;
                    $filePath = basename($file);
                    if (strpos($filePath, $className) !== false || strpos($fullPath, $className) !== false) {
                        $command = sprintf(
                            __DIR__ . '/vendor/phpunit/phpunit/phpunit --filter %s %s %s',
                            $funcName,
                            basename($file, ".php"),
                            $fullPath
                        );
                        echo $command . "\r\n";
                        system($command);
                    }
                }
            }
        }
        closedir($handle);
    }
}

list(, $function, $class) = $argv;
run(__DIR__ . "/tests/", $class, $function);
