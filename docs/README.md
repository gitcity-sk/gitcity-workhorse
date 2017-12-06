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


{% method %}
## With GIT {#withGit}

Clone repository somewhere to your application folder

{% sample lang="php" %}
```bash
git clone https://github.com/MayMeow/uuid.git
```

{% endmethod %}

{% method %}
## With Composer {#withComposer}

Install with composer. for future update you will need run `composer update` from your application folder.

{% sample lang="php" %}
```bash
composer require may-meow-cloud/socket-server
```

{% endmethod %}

{% method %}
## Running application as service {#runnningAsService}

1. Copy your application to `/opt/<my-app-name>` folder.
2. As root reate service configuration file `sudo touch /lib/systemd/system/mcloudapi.service` and paste there following content you can see right.
3. Start service `sudo systemctl start mcloudapi.service`
4. Run service after startup (optional) important for unattended server agent `sudo systemctl enable mcloudapi.service`

{% sample lang="php" %}
```bash
[Unit]
Description=May Meow Cloud API Daemon
After=network.target

[Service]
ExecStart=/usr/bin/php /opt/<my-app-name>/<your-script-name>.php
WorkingDirectory=/opt/mcloudapi
Type=simple
Restart=always
RestartSec=10
KillMode=process

[Install]
WantedBy=multi-user.target
```

{% endmethod %}
