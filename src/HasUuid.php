<?php

namespace Codesmith\Eloquent\Uuid;

use Ramsey\Uuid\Uuid;
use Illuminate\Contracts\Routing\UrlRoutable;

trait HasUuid
{
    /**
     * The "booting" method of the trait.
     *
     * @return void
     */
    static function bootHasUuid()
    {
        self::creating(function ($model) {
            if (! $model->offsetExists($model->getUidKeyName())) {
                $model->setAttribute($model->getUidKeyName(), Uuid::uuid1()->toString());
            }
        });
    }

    /**
     * Execute the query and get the first result.
     *
     * @param  array   $columns
     * @return \stdClass|array|null
     */
    static function findByUuid($uuid, $columns = ['*'])
    {
        return self::whereUuid($uuid)->first($columns);
    }

    /**
     * Get the uuid key name
     * @return [type] [description]
     */
    function getUidKeyName()
    {
        return property_exists($this, 'uuidKey') ? $this->uuidKey : 'uuid';
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    function getRouteKeyName()
    {
        return $this->getUidKeyName();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    function getRouteKey()
    {
        return $this->getAttribute($this->getUidKeyName());
    }
}
