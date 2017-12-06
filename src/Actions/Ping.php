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
 * @file Ping.php
 */

/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 9:16 PM
 */

namespace MayMeow\Cloud\Sockets\Actions;

use Symfony\Component\Process\Process;

class Ping extends AbstractAction
{
    /**
     * 
     */
    protected function configure()
    {
        $this
            ->setName('Ping');
    }

    /**
     * @param null $what
     * @return string
     *
     * On input is simple string
     */
    public function response($data = null)
    {
        $process = new Process('ping ' . $data->host);
        $process->start();
        while ($process->isRunning()) {
            // waiting for process to finish
        }

        return trim($process->getOutput());
    }
}