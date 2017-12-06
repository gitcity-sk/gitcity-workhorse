<?php
/**
 * This file is part of MayMeow/SocketServer project
 * Copyright (c) 2017 Charlotta Jung
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright Copyright (c) Charlotta MayMeow Jung
 * @link      http://maymeow.click
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 *
 * @project maymeow-cloud-api
 * @file agent_reg.php
 */

require_once 'vendor/autoload.php';
require_once 'config/paths.php';

$configuration = new \MayMeow\Cloud\Sockets\Rest\AgentConfig();

$configuration
    ->setServer('http://eu1-west.maymeow.cloud')
    ->setAppKey('0000')
    ->setAppSecret('1a2s')
    ->write();