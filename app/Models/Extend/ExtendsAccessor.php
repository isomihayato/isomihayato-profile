<?php

namespace App\Models\Extend;

trait ExtendsAccessor
{

    protected static $getter = [];
    protected static $setter = [];

    protected static function extendAccessor($key, $method, $mode = 'get')
    {
        $arr = $mode . 'ter';
        static::$$arr[$key] = $method;
    }

    public function getAttribute($key)
    {
        if (isset(static::$getter[$key])) {
            $method = static::$getter[$key];
            return $this->$method($key);
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if (isset(static::$setter[$key])) {
            $method = static::$setter[$key];
            return $this->$method($key, $value);
        }
        return parent::setAttribute($key, $value);
    }
}
