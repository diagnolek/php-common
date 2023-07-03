<?php
/**
 * @author Sebastian Pondo
 */

spl_autoload_register(function($class) {
    $logicalPathPsr4 = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';
    $subPath = $class;
    $corePath = __DIR__;
    while (false !== $lastPos = strrpos($subPath, '\\')) {
        $dir = '';
        $subPath = substr($subPath, 0, $lastPos);
        $search = $subPath . '\\';
        if ($search == 'Db\\Example\\') {
            $dir = $corePath.DIRECTORY_SEPARATOR.'Propel'.DIRECTORY_SEPARATOR.'src';
        }
        if ($dir) {
            if (file_exists($file = $dir.DIRECTORY_SEPARATOR.$logicalPathPsr4)) {
                include_once $file;
            }
        }
    }
});
