<?php
/**
 * This file is part of MayMeow/SocketServer project
 * Copyright (c) 2017 Martin Kukolos
 * Copyright (c) 2017 MayMeow.Cloud Team
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright Copyright (c) Martin Kukolos
 * @copyright Copyright (c) MayMeow.Cloud Team
 * @link      http://maymeow.click
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 *
 * @project maymeow-cloud-api
 * @file routes.php
 */

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/**
 * The full path to the directory which holds "src", WITHOUT a trailing DS.
 * dirname — Returns a parent directory's path
 */
define('ROOT', dirname(__DIR__));

/**
 * The full path to the actual working directory directory, WITHOUT a trailing DS.
 * Important if you want use script as commandline utility globally
 * getcwd — Gets the current working directory
 */
define('CLI_ROOT', getcwd());

/**
 * File path to the config directory.
 */
define('CONFIG', ROOT . DS . 'config' . DS);