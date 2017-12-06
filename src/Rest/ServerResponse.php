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
 * @file ServerResponse.php
 */

/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 11:06 PM
 */

namespace MayMeow\Cloud\Sockets\Rest;

class ServerResponse implements ServerResponseInterface
{
    protected $serverIdentity = 'MayMeow Sock Server';

    /**
     * @param null $action
     * @param null $data
     * @return string
     */
    public function success($action = null, $data = null)
    {
        $object = [
            'server' => $this->serverIdentity,
            'response' => 'OK',
            'code' => '200',
            'action' => $action,
            'data' => $data
        ];

        return json_encode($object);
    }

    /**
     * @param null $action
     * @param null $data
     * @return string
     */
    public function notFound($action = null, $data= null)
    {
        $object = [
            'server' => $this->serverIdentity,
            'response' => 'NotFound',
            'code' => '404',
            'action' => $action
        ];

        return json_encode($object);
    }
}