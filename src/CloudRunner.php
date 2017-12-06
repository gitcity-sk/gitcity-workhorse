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
 * @file CloudRunner.php
 */

/**
 * Created by PhpStorm.
 * User: martin
 * Date: 3/19/2017
 * Time: 4:43 PM
 */

namespace MayMeow\Cloud\Sockets;


use MayMeow\Cloud\Sockets\Actions\ActionInterface;
use MayMeow\Cloud\Sockets\Rest\Response;

class CloudRunner
{
    protected $connection = true;

    protected $configuration;

    public $actions = [];

    function __construct()
    {
        if (file_exists(CONFIG . 'agent.json'))
        {
            $this->configuration = json_decode(file_get_contents(CONFIG . 'agent.json'));
        }
    }

    public function addAction(ActionInterface $action)
    {
        $this->actions[$action->getName()] = $action;
    }

    /**
     *
     */
    public function run()
    {
        while ($this->connection)
        {
            sleep(5);

            if ($this->configuration) {
                // try to connect to server

                $configurationString =  "{$this->configuration->server}/m-cloud-compute/api/v1/outgoing-actions/check/{$this->configuration->app_key}/{$this->configuration->app_secret}.json";

                $request = file_get_contents($configurationString);
                $request = json_decode($request);

                if ($request != null && array_key_exists($request->action, $this->actions)) {
                    echo "Calling action: $request->action \n";
                    $action = $this->actions[$request->action];
                    var_dump($request->data);
                    $actionAnsver = $action->response($request->data);
                    print_r($actionAnsver);
                    /*$jo = new ServerResponse();
                    $response = $jo->success($request->action, $actionAnsver);*/
                } else {
                    //echo "NotFound action: $request->action \n";
                    //echo $request != null ? "NotFound action: $request->action \n" : "No action to call. \n";
                    if ($request != null) {
                        $response = new Response();
                        $response->notFound();

                        echo $response->toString();
                    } else {
                        $response = new Response();
                        $response->success()->setMessage('No action to call');

                        echo $response->toString();
                    }
                    /*$jo = new ServerResponse();
                    $response = $jo->notFound($request->action);*/
                }

            } else {
                echo "please register \r\n";
            }
        }
    }
}