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
 * @file SocketClient.php
 */

/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 10:45 PM
 */

namespace MayMeow\Cloud\Sockets;

class SocketClient
{
    protected $server;

    protected $data;

    /**
     * SocketClient constructor.
     * @param $socket
     */
    public function __construct($socket)
    {
        $this->_setSocket($socket);
    }

    /**
     * @param $socket
     */
    protected function _setSocket($socket)
    {
        $this->server = stream_socket_client($socket, $errno, $errstr, 30);

        if(!$this->server) {
            echo "$errstr ($errno)";
        }
    }

    /**
     * @param null $action
     * @return $this
     */
    public function setAction($action = null)
    {
        $this->data['action'] = $action;

        return $this;
    }

    /**
     * @param null $data
     * @return $this
     */
    public function setData($data = null)
    {
        $this->data['data'] = $data;

        return $this;
    }

    /**
     * @param $data
     * @return null|string
     */
    public function run($data = null)
    {
        if (!$this->server) {
            return false;
        }

        $data != null ? $this->data = $data : null;

        $out = json_encode($this->data);
        fwrite($this->server, $out);

        return $this->_read();
    }

    /**
     * @return null|string
     */
    protected function _read()
    {
        $response = null;
        while (!feof($this->server)){
            $response .= fgets($this->server, 1024*8);
        }

        return $response;
    }
}
