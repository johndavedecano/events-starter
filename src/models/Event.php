<?php
/**
 * Created by PhpStorm.
 * User: jdecano
 * Date: 6/16/2016
 * Time: 1:08 PM
 */

namespace Jdecano\EventsStarter\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * @package Jdecano\EventsStarter
 */

class Event extends Model
{
    /**
     * @var string
     */
    protected $table = 'events';
    /**
     * @var array
     */
    protected $fillable = ['title', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function setting()
    {
        return $this->hasOne('Jdecano\EventsStarter\Models\EventSetting', 'event_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function occurrences()
    {
        return $this->hasMany('Jdecano\EventsStarter\Models\EventOccurrence', 'event_id');
    }
}