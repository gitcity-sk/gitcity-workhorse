<?php
/**
 * This file is part of MayMeow/SocketServer project
 * Copyright (c) 2017 Martin Kukolos
 * Copyright (c) 2017 MayMeow.Codes Team
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * @copyright Copyright (c) Martin Kukolos
 * @copyright Copyright (c) MayMeowCodes.Team
 * @link      http://maymeow.click
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 *
 * @project maymeow-cloud-api
 * @file RegisterAction.php
 */

namespace MayMeow\Cloud\Sockets\Actions;

class RegisterAction extends AbstractAction implements ActionInterface
{
    protected function configure()
    {
        $this
            ->setName('Register')
            ->setServiceType('audio');

    }

    public function response($options = null)
    {
        return $this->serviceType;
    }
}