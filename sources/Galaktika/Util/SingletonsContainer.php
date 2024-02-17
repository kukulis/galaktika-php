<?php

namespace Galaktika\Util;

class SingletonsContainer
{
    private static ?SingletonsContainer $instance = null;

    private array $singletons = [];

    public static function instance() : self  {
        if (static::$instance == null ) {
            static::$instance = new SingletonsContainer();
        }

        return static::$instance;
    }

    public function getSingleton(string $key, callable $constructor=null) {
        if ( array_key_exists( $key, $this->singletons)) {
            return $this->singletons[$key];
        }

        if ( $constructor == null ) {
            return null;
        }

        $singleton = call_user_func($constructor);
        $this->singletons[$key] = $singleton;

        return $singleton;
    }

}