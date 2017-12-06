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
 * @file Process.php
 */

namespace MayMeow\Cloud\Sockets;

class Process
{
    protected $pid;

    protected $command;

    protected $processName = null;

    function __construct($command = null)
    {
        if ($command) {
            $this->command = $command;
        }
    }

    protected function _runCommand()
    {
        $command = 'nohup ' . $this->command . ' > /dev/null 2>&1 & echo $!';
        exec($command, $top);

        $this->pid = (int)$top[0];
    }

    /**
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param mixed $pid
     * @return Process
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
        return $this;
    }

    public function setProcessName($processName)
    {
        $this->processName = $processName;
        return $this;
    }

    /**
     * @return null
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param null $command
     * @return Process
     */
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }

    public function status()
    {
        $command = 'ps -p' . $this->pid;
        exec($command, $top);

        if (!isset($top[1])) return false;

        return true;
    }

    /**
     *
     */
    public function start()
    {
        if ($this->command != '') $this->_runCommand();
    }

    /**
     * @return bool
     */
    public function stop()
    {
        $command = 'kill ' . $this->pid;
        exec($command);

        return $this->status() == false ? true : false;
    }

    /**
     * @return bool
     */
    public function stopAll()
    {
        if($this->processName == null) return false;

        $command = 'killall ' . $this->processName;
        exec($command);

        return true;
    }
}
