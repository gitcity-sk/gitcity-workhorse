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
 * @file agnt.php
 */

/**
 * Created by PhpStorm.
 * User: martin
 * Date: 3/19/2017
 * Time: 4:48 PM
 */

require_once 'vendor/autoload.php';
require_once 'config/paths.php';

$agent = new \MayMeow\Cloud\Sockets\CloudRunner();

$agent->addAction(new \MayMeow\Cloud\Sockets\Actions\Ping());

$agent->run();