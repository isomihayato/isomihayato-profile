<?php

namespace App\Models\Extend;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

trait ServicesAccessor
{

    /**
     * Get managed service
     *
     * @return \App\Services\Extend\ServiceInterface|null
     */
    public function service()
    {
        $class = basename(strtr(get_class($this), '\\', '/'));
        $service = 'App\\Services\\' . Str::studly(substr($class, -strrpos($class, '\\'))) . 'Service';
        return App::has($service) ? App::get($service) : null;
    }

    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasGetMutator($key)
    {
        $service = $this->service();
        // if (str_ends_with($key, '_ids')) {
        //     return true;
        // }
        if (!is_null($service) && method_exists($service, 'get'.Str::studly($key).'Attribute')) {
            return true;
        }
        return parent::hasGetMutator($key);
    }

    /**
     * Get a plain attribute (not a relationship).
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        $service = $this->service();
        $studlyKey = Str::studly($key);
        $function = 'get'.$studlyKey.'Attribute';
        // if (str_ends_with($key, '_ids')) {

        //     return (!empty($this->attributes[$key])) ? explode(',', $this->attributes[$key]) : [];
        // }
        if (!is_null($service) && method_exists($service, $function)) {
            if (!isset($this->attributes[$key])) {
                $this->attributes[$key] = $service->$function($this);
                $this->hidden[] = $key;
            }
            return $this->attributes[$key];
        }
        return parent::getAttributeValue($key);
    }

    // /**
    //  * Determine if a set mutator exists for an attribute.
    //  *
    //  * @param  string  $key
    //  * @return bool
    //  */
    // public function hasSetMutator($key)
    // {
    //     if (str_ends_with($key, '_ids')) {
    //         return true;
    //     }
    //     return parent::hasSetMutator($key);
    // }

    // /**
    //  * Set the value of an attribute using its mutator.
    //  *
    //  * @param  string  $key
    //  * @param  mixed  $value
    //  * @return mixed
    //  */
    // protected function setMutatedAttributeValue($key, $value)
    // {
    //     if (str_ends_with($key, '_ids')) {
    //         $value = Partial::array($value);
    //         $this->attributes[$key] = (is_array($value)) ? implode(',', $value) : '';
    //         return $this->attributes[$key];
    //     }
    //     return parent::setMutatedAttributeValue($key, $value);
    // }
}