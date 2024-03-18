<?php
class EventDispatcher {
    private $listeners = [];

    public function addEventListener($eventName, $callback) {
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }
        $this->listeners[$eventName][] = $callback;
    }

    public function dispatchEvent($eventName, $data = null) {
        if (isset($this->listeners[$eventName])) {
            foreach ($this->listeners[$eventName] as $callback) {
                if (is_callable($callback)) {
                    call_user_func($callback, $data);
                }
            }
        }
    }
}

// Example usage
$dispatcher = new EventDispatcher();

$dispatcher->addEventListener('click', function($data) {
    echo "Click event fired! Data: $data<br>";
});

$dispatcher->addEventListener('hover', function($data) {
    echo "Hover event fired! Data: $data<br>";
});

$dispatcher->dispatchEvent('click', 'Button clicked');
$dispatcher->dispatchEvent('hover', 'Mouse over');
