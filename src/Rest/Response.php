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
 * @file Response.php
 */

/**
 * Created by PhpStorm.
 * User: martin
 * Date: 3/24/2017
 * Time: 7:24 PM
 */

namespace MayMeow\Cloud\Sockets\Rest;

use MayMeow\Cloud\Sockets\Factories\ResponseCodeFactory;

class Response
{
    /**
     * Process identifier if action create process on server
     *
     * @var null|string|int $pid
     */
    protected $pid = null;

    /**
     * Response data from action
     *
     * @var string|array|null $data
     */
    protected $data;

    /**
     * Returns response code
     *
     * @var int $code
     */
    protected $code;

    /**
     * Response message - in readable format
     *
     * @var string $message
     */
    protected $message;

    /**
     * Name of action which returns response
     *
     * @var string $actionName
     */
    protected $actionName;

    /**
     * @param int|null|string $pid
     * @return Response
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
        return $this;
    }

    /**
     * @param array|null|string $data
     * @return Response
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param int $code
     * @return Response
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param string $message
     * @return Response
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $actionName
     * @return Response
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
        return $this;
    }

    /**
     * @return Response
     */
    public function success()
    {
        $this->code = ResponseCodeFactory::SUCCESS_CODE;
        $this->message = 'Success';

        return $this;
    }

    /**
     * @return Response
     */
    public function denied()
    {
        $this->code = ResponseCodeFactory::FORBIDDEN_CODE;
        $this->message = 'Access denied';

        return $this;
    }

    /**
     * @return Response
     */
    public function notFound()
    {
        $this->code = ResponseCodeFactory::NOT_FOUND_CODE;
        $this->message = 'Not Found';

        return $this;
    }

    public function serialize()
    {
        return json_encode(get_object_vars($this));
    }

    public function toString()
    {
        return $this->code . ' ' . $this->message . "\r\n";
    }
}