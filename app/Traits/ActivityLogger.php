<?php

namespace App\Traits;

use App\Activity;
use Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait ActivityLogger {

    /**
     * Automatically boot with Model, and register Events handler.
     */
    protected static function bootActivityLogger()
    {
        foreach (static::getRecordActivityEvents() as $eventName) {
            static::$eventName(function ($model) use ($eventName) {
                try {
                    $reflect = new \ReflectionClass($model);

                    $m = new Activity();

                    $m->user_id  = getUserID();
                    $m->content_id = $model->attributes[$model->primaryKey];
                    $m->content_type = get_class($model);
                    $m->action = static::getActionName($eventName);
                    $m->description = ucfirst($eventName) . " a " . $reflect->getShortName();
                    $m->details = json_encode($model->getDirty());
                    $m->ip_address = json_encode($model->getDirty());
                    $m->ip_address = Request::ip();

                    $m->save();

                } catch (\Exception $e) {
                    Log::debug($e->getMessage());
                }
            });
        }
    }

    /**
     * Set the default events to be recorded if the $recordEvents
     * property does not exist on the model.
     *
     * @return array
     */
    protected static function getRecordActivityEvents()
    {
        if (isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return [
            'created',
            'updated',
            'deleted',
            //'restored'
        ];
    }

    /**
     * Return Suitable action name for Supplied Event
     *
     * @param $event
     * @return string
     */
    protected static function getActionName($event)
    {
        switch (strtolower($event)) {
            case 'created':
                return 'create';
                break;
            case 'updated':
                return 'update';
                break;
            case 'deleted':
                return 'delete';
                break;
           /* case 'restored':
                return 'restore';
                break;*/
            default:
                return 'unknown';
        }
    }
}