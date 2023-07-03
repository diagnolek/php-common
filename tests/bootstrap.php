<?php
/**
 * @author Sebastian Pondo
 */

$ds = DIRECTORY_SEPARATOR;
require_once 'loader.php';

if (!file_exists(__DIR__.'/Propel/config/config.php')) {
    exec('php '.__DIR__.$ds.'Propel'.$ds.'console.php config:convert --config-dir='.__DIR__.$ds.'Propel');
}

require_once 'Propel/config/config.php';
