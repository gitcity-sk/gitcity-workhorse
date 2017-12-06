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
 * @file SimpleSum.php
 */

/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 11:40 PM
 */

namespace MayMeow\Cloud\Sockets\Actions;

class SimpleSum extends AbstractAction
{
    protected function configure()
    {
        $this
            ->setName('Suma');
    }

    /**
     * @param null $options
     * @return mixed
     *
     * On input we use 'options' => ['a' => 1, 'b' => 2]
     */
    public function response($options = null)
    {
        return $options->a + $options->b;
    }
}