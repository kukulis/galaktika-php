<?php

namespace Galaktika\Dummy;

use Closure;
use Psr\EventDispatcher\EventDispatcherInterface;

class DummyEventDispatcher implements EventDispatcherInterface
{
    /** @var Closure[] */
    private array $listenersRegistry = [];

    public function dispatch(object $event)
    {
        $listenersList = $this->listenersRegistry[get_class($event)];
        foreach ($listenersList as $listener) {
            call_user_func($listener, $event);
        }
    }

    public function registerListener(string $eventClass, callable $listener)
    {
        if (!array_key_exists($eventClass, $this->listenersRegistry)) {
            $this->listenersRegistry[$eventClass] = [];
        }
        $this->listenersRegistry[$eventClass][] = $listener;
    }
}