# Actions

Actions are classes with server functionality.

{% method %}
## Create your won action {#crateAction}

Each action must extends `AbstractAction` and must contain `configure()` and `response()` function. Here is example of __ping__ action.

### Action name (since v0.0.2)

To set action name put `$this->setName('yourActionName')` into `configure()` function.

{% sample lang="php" %}
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

{% endmethod %}
