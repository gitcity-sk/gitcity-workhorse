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
 * @file srv.php
 */

require_once 'vendor/autoload.php';
require_once 'config/paths.php';

$server = new \MayMeow\Cloud\Sockets\SocketServer('tcp://0.0.0.0:18801');

/*$server->actions = [
    'Ping' => new \MayMeow\Actions\Ping(),
    'Pong' => new \MayMeow\Actions\Pong()
];*/

// Register server actions
$server->addAction(new \MayMeow\Cloud\Sockets\Actions\Ping());
$server->addAction(new \MayMeow\Cloud\Sockets\Actions\Pong());
$server->addAction(new \MayMeow\Cloud\Sockets\Actions\RegisterAction());
$server->addAction(new \MayMeow\Cloud\Sockets\Actions\Git\GitInitAction());
$server->addAction(new \MayMeow\Cloud\Sockets\Actions\Security\WriteKeysAction());
/*$server->addAction('Pong', new \MayMeow\Actions\Pong());
$server->addAction('Sum', new \MayMeow\Actions\SimpleSum());*/

// Run server
$server->connect();
