<?php
/**
 * Created by PhpStorm.
 * User: MayMeow
 * Date: 2/21/2017
 * Time: 7:40 PM
 */

$connection = true;

$socketConfig= [];

$server = stream_socket_server('tcp://0.0.0.0:4444', $errno, $errnoMessage);

if ($server === false) {
    die("Could not bind socket $errnoMessage");
}

$client_socks = [];

while($connection) {
    $read_socks = $client_socks;
    $read_socks[] = $server;

    if(!stream_select($read_socks, $write, $except, 300000))
    {
        die('Something went wrong');
    }

    //new client
    if(in_array($server, $read_socks)) {
        $new_client = stream_socket_accept($server);

        if($new_client)
        {
            //print remote client information, ip and port number
            echo 'Connection accepted from ' . stream_socket_get_name($new_client, true) . "\n";

            $client_socks[] = $new_client;
            echo "Now there are total ". count($client_socks) . " clients \n";
        }

        //delete the server socket from the read sockets
        unset($read_socks[ array_search($server, $read_socks) ]);
    }

    //message from exissting client
    foreach ($read_socks as $sock)
    {
        $data = fread($sock, 1024);
        $socketID = array_search($sock, $client_socks);

        // ak data niesu tak error
        if(!$data) {
            unset($client_socks[ $socketID ]);
            @fclose($sock);
            echo "A client disconnected. Now there are total ". count($client_socks) . " clients \n";
            continue;
        }
        //send the message back to client

        $ac = json_decode($data);

        if ($ac->action == 'ping') {
            $response = [
                'server' => 'MayMeow Sock Server v 3.0',
                'action' => $ac->action,
                'response' => 'OK',
                'data' => trim(exec('ping 192.168.4.1'))
            ];
            $data = json_encode($response);
        } else {
            $response = [
                'server' => 'MayMeow Sock Server v 3.0',
                'action' => $ac->action,
                'response' => 'FAILED',
            ];
            $data = json_encode($response);
        }

        fwrite($sock, $data);

        unset($client_socks[ $socketID ]);
        @fclose($sock);

    }
}
