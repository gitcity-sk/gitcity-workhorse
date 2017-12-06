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
 * @file SocketServer.php
 */

/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 8:38 PM
 */

namespace MayMeow\Cloud\Sockets;

use MayMeow\Cloud\Sockets\Actions\ActionInterface;
use MayMeow\Cloud\Sockets\Rest\ServerResponse;

class SocketServer
{
    protected $connection = true;

    protected $server;

    protected $clientSockets = [];

    protected $readSockets = [];

    public $actions = [];

    public function __construct($socket)
    {
        $this->_setServer($socket);
    }

    function __destruct() {
     // TODO: Implement __destruct() method.
    }

    /**
     * @param $socket
     */
    protected function _setServer($socket)
    {
        $this->server = stream_socket_server($socket, $errno, $errnoMessage);

        if ($this->server === false) {
            die("Could not bind socket $errnoMessage");
        }
    }

    /**
     * @param ActionInterface $action
     */
    public function addAction(ActionInterface $action)
    {
        $this->actions[$action->getName()] = $action;
    }

    /**
     * Function connect
     */
    public function connect()
    {
        while ($this->connection) {
            $this->readSockets = $this->clientSockets;
            $this->readSockets[] = $this->server;

            if(!stream_select($this->readSockets, $write, $except, 300000)) {
                die('Something went wrong');
            }

            /**
             * Check clients and if there is new client add it to array
             */
            if (in_array($this->server, $this->readSockets)) {
                $this->_checkClient();
            }

            // read what client send
            $this->_read();
        }
    }

    /**
     * Function _checkClient
     */
    protected function _checkClient()
    {

        $newClient = stream_socket_accept($this->server);

        if ($newClient) {
            //print remote client information, ip and port number
            echo 'Connection accepted from ' . stream_socket_get_name($newClient, true) . "\n";

            $this->clientSockets[] = $newClient;
            echo "Now there are total ". count($this->clientSockets) . " clients \n";
        }

        unset($this->readSockets[ array_search($this->server, $this->readSockets) ]);


    }

    /**
     * function _read
     */
    protected function _read() {
        foreach ($this->readSockets as $socket) {
            $data = fread($socket, 1024*8);

            $socketID = array_search($socket, $this->clientSockets);

            if (!$data) {
                $this->_close($socketID, $socket);
                continue;
            }

            // Decode request JSON string
            $request = json_decode($data);

            if (array_key_exists($request->action, $this->actions)) {
                echo "Calling action: $request->action \n";
                $action = $this->actions[$request->action];
                $actionAnsver = $action->response($request->data);
                $jo = new ServerResponse();
                $response = $jo->success($request->action, $actionAnsver);
            } else {
                echo "NotFound action: $request->action \n";
                $jo = new ServerResponse();
                $response = $jo->notFound($request->action);
            }

            fwrite($socket, $response);

            $this->_close($socketID, $socket);
        }
    }

    /**
     * @param $socketID
     * @param $socket
     */
    protected function _close($socketID, $socket)
    {
        unset($this->clientSockets[$socketID]);
        @fclose($socket);
        echo "A client disconnected. Now there are total ". count($this->clientSockets) . " clients \n";
    }

}
