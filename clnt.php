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
 * @file clnt.php
 */

/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 10:53 PM
 */



require_once 'vendor/autoload.php';

$client = new \MayMeow\Cloud\Sockets\SocketClient('tcp://localhost:8801');

/*$response = $client->run([
    'action' => 'Ping',
    'data' => 'google.com'
]);*/
/*$response = $client->setAction('GetContainers')->run();

if ($response) {
    $response = json_decode($response);
}

print_r($response);*/

/*foreach ($response->data as $container) {
    echo "10.11.220.12" . $container->Names[0] . ": " . $container->State . " - " . $container->Id . "\r\n";
}*/

$response = $client->setAction('git:init:bare')
    ->setData([
        'path' => '/var/opt/gitcity/git-data/my-repo-5.git'
    ])
    ->run();

print_r(json_decode($response));
