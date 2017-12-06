<?php
/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 7:45 PM
 */

//$fp = fsockopen('localhost', 4444, $errno, $errstr, 30);

$fp = stream_socket_client("tcp://localhost:4443", $errno, $errstr, 30);

if (!$fp)
{
    echo "$errstr ($errno)";
} else {
    $command = [
        'action' =>  'Pong',
    ];


    $out = json_encode($command) . "\r\n";

    fwrite($fp, $out);

    //recieve data
    while (!feof($fp)){
        $text = fgets($fp, 1024);

        echo $text;

    }

    fclose($fp);
    exit();
}
