<?php

namespace FunctionsModules\Utils;

use RuntimeException;

trait Filesystem
{
    /**
     * @param array $folders
     *
     * @return void
     */
    protected function createFolderIfNotExist(array $folders): void
    {
        foreach ($folders as $folder) {
            if ( ! is_dir($folder) && ! mkdir($folder, 0777, true) && ! is_dir($folder)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $folder));
            }
        }
    }

    /**
     * @param string $file
     *
     * @return void
     */
    protected function createFileIfNotExist(string $file): void
    {
        if ( ! file_exists($file)) {
            $fp = fopen($file, 'wb');
            fwrite($fp, 'The ' . $file . ' is initialized');
            fclose($fp);
        }
    }
}