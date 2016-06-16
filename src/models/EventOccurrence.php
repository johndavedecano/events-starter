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
 * Class EventOccurrence
 * @package Jdecano\EventsStarter
 */
class EventOccurrence extends Model
{
    /**
     * @var string
     */
    protected $table = 'events_occurrences';
    /**
     * @var array
     */
    protected $fillable = ['event_id', 'date'];
    /**
     * @var array
     */
    protected $dates = ['date'];
    /**
     * @var bool
     */
    public $timestamps = false;
}