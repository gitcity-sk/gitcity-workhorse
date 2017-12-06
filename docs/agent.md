# Agent - Cloud runner

Script is running on your device and check every few seconds if he has outgoing action on server. Agent is __do not__ need public IP address and port.

{% method %}
## Initialize {#initialize}

Before each use you need initialize agent class and run it

{% sample lang="php" %}
```php
require_once 'vendor/autoload.php';
require_once 'config/paths.php';

$agent = new \MayMeow\Cloud\Sockets\CloudRunner();

// ... place for register actions

$agent->run();
```

{% endmethod %}


{% method %}
## Actions {#actions}

Each action you wat to use with agent must be registered

{% sample lang="php" %}
```php
// register action Ping()
$agent->addAction(new \MayMeow\Cloud\Sockets\Actions\Ping());
```

{% endmethod %}
