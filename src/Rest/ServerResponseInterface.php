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
 * @file ServerResponseInterface.php
 */

/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 11:35 PM
 */

namespace MayMeow\Cloud\Sockets\Rest;

interface ServerResponseInterface
{
    /**
     * @param null $action
     * @param null $data
     * @return mixed
     */
    public function success($action = null, $data = null);

    /**
     * @param null $action
     * @param null $data
     * @return mixed
     */
    public function notFound($action = null, $data= null);
}