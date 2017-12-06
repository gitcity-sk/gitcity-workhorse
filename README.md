# Socket Server

Simple socket server and client implementation

## Requirements

* PHP 5.5 and up
* Composer

## What is included
* __Server:__ Is simple socket server. Listening on given port for API calls.
* __Client:__ Is client for socket server.
* __Agent:__ Is klient like app which in defined time checking cloud server for actions.

### What is required

Here You can see requirements per apps. For server is recommended to have static ip address or you will have to use one of DDNS services.

|App|Public Ip address|Port Redirection|Server|
|---|---|---|---|
|Server|Yes|Yes|No|
|Client|No|No|Yes|
|Agent|No|No|Yes - Cloud|

* Server and client need update configuration every time you IP is changed. 
* Agent is not IP dependent. (Cloud server using DNS name)

## Installation

Clone respository

```bash
git clone https://github.com/MayMeow/uuid.git
```

With Composer - COMMINT SOON

## Usage

## Server

Create file foy your server, for exmaple `server.php` and load Socket server:

```php
$server = new \MayMeow\Cloud\Sockets\SocketServer('tcp://0.0.0.0:4443');

// ... here you can define actions

// run server
$server->connect();
```
To start server call `php server.php` Server will listen on port 4443 on any ipaddress. And you will see log of connected
client and called actions.

This server will ansver wit NotFound to any action which is called by client. Before you can use action you have to register them.

### Registering actions

```php
// Register server actions. This block must be before $server->connect()
$server->addAction('Ping', new \MayMeow\Cloud\Sockets\Actions\Ping());
$server->addAction('Pong', new \MayMeow\Cloud\Sockets\Actions\Pong());

// From version 0.0.2
// Names are defined in Actions php file
$server->addAction(new \MayMeow\Cloud\Sockets\Actions\Pong());
```

### Creating actions 

```php
namespace MayMeow\Actions;

class Ping extends AbstractAction
{
    /**
     * From Version 0.0.2 you have to define action name in configure function
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
    public function response($what = null)
    {
        return trim(exec('ping ' . $what));
    }
}
```

## Client

Create file `client.php` and load SocketClient

```php
$client = new \MayMeow\SocketClient('tcp://localhost:4443');
```

Call Action and get response

```php
$response = $client->run([
    'action' => 'Pong',
    'data' => 'May'
]);

echo $response;

// {"server":"MayMeow Sock Server","response":"OK","code":"200","action":"Pong","data":"Hello World May"}
```

Version 0.0.2 and up

```php
$response = $client->
    ->setAction('Pong')
    ->setData('May')->run();

echo $response;

// {"server":"MayMeow Sock Server","response":"OK","code":"200","action":"Pong","data":"Hello World May"}
```

## Agent

For using agent you will need create account on our cloud server, but for now is not available for public users. If you want to test it contact us.

1. Create agent

```php
require_once 'vendor/autoload.php';
require_once 'config/paths.php';

$agent = new \MayMeow\Cloud\Sockets\CloudRunner();

// ... place for register actions
$agent->addAction(new \MayMeow\Cloud\Sockets\Actions\Ping());

$agent->run();
```

2. Create Configuration file called `config/agent.json`. For content follow instruction on agent view page (cloud server)

3. Run your agent and enjoy :)


## Responses

### Success

```json
{
  "server":"MayMeow Sock Server",
  "response":"OK","code":"200",
  "action":"ActionName",
  "data":"Requested data"
}
```

### NotFound

```json
{
  "server":"MayMeow Sock Server",
  "response":"NotFound",
  "code":"404",
  "action":"ActionName"
}
```

## Running as a service

1. As root create file

`sudo touch /lib/systemd/system/mcloudapi.service`

2. Update file with following content

```bash
[Unit]
Description=May Meow Cloud API Daemon
After=network.target

[Service]
User=git
Group=git
ExecStart=/usr/bin/php /opt/mcloudapi/srv.php
WorkingDirectory=/var/opt/gitcity/git-data
Type=simple
Restart=always
RestartSec=10
KillMode=process

[Install]
WantedBy=multi-user.target
```

3. Make systemd load the new unit

`sudo systemctl daemon-reload`

4. Start service

`sudo systemctl start mcloudapi.service`

5. Run after startup (optional)

`sudo systemctl enable mcloudapi.service`

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request.

## Credits

[MayMeow.Cloud](https://github.com/may-meow-cloud)

## License

MIT

```
sudo git clone https://gitcity.sk/cakeapp-sk/cakeapp-workhorse.git /opt/gitcity-workhorse \
&& sudo chown -R git:git /opt/gitcity-workhorse \
&& cd /opt/gitcity-workhorse \
&& sudo -u git composer install
```