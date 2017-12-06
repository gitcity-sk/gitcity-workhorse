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
 * @file AbstractAction.php
 */

/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 9:41 PM
 */

namespace MayMeow\Cloud\Sockets\Actions;


class AbstractAction implements ActionInterface
{
    /**
     * Store Name of action
     *
     * @var $name
     */
    protected $name;

    /**
     * Store service type in case of registration your agent for MCloudHome
     *
     * @var $serviceType
     */
    protected $serviceType;

    /**
     * Function getName
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    protected function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * AbstractAction constructor.
     */
    public function __construct()
    {
        $this->configure();
    }

    /**
     * @return mixed
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * @param $serviceType
     * @return $this
     */
    protected function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;

        return $this;
    }



    /**
     * Function configure
     *
     * Runs at Class construct and set default variables like name
     */
    protected function configure()
    {

    }

    /**
     * Function Response
     * @param null $options
     * @return string
     *
     * Simple string on input
     */
    public function response($options = null)
    {
        return 'Hello World ' . $options;
    }
}