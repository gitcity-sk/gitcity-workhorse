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
 * @file AgentConfig.php
 */

/**
 * Created by PhpStorm.
 * User: martin
 * Date: 3/19/2017
 * Time: 5:06 PM
 */

namespace MayMeow\Cloud\Sockets\Rest;


class AgentConfig
{
    protected $server;

    protected $app_key;

    protected $app_secret;

    /**
     * @param mixed $server
     * @return AgentConfig
     */
    public function setServer($server)
    {
        $this->server = $server;
        return $this;
    }

    /**
     * @param mixed $app_key
     * @return AgentConfig
     */
    public function setAppKey($app_key)
    {
        $this->app_key = $app_key;
        return $this;
    }

    /**
     * @param mixed $app_secret
     * @return AgentConfig
     */
    public function setAppSecret($app_secret)
    {
        $this->app_secret = $app_secret;
        return $this;
    }

    public function serialize()
    {
        return json_encode(get_object_vars($this));
    }

    public function write()
    {
        file_put_contents(CONFIG . "agent.json", $this->serialize());
    }
}