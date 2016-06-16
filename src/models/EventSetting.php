<?php
/**
 * Created by PhpStorm.
 * User: jdecano
 * Date: 6/16/2016
 * Time: 1:08 PM
 */

namespace Jdecano\EventsStarter\Models;


use Illuminate\Database\Eloquent\Model;
use Jdecano\EventsStarter\Adapter;
use RRule\RRule;


/**
 * Class EventSetting
 * @package Jdecano\EventsStarter
 */
class EventSetting extends Model
{
    /**
     * @var string
     */
    protected $table = 'events_settings';
    /**
     * @var array
     */
    protected $fillable = ['event_id', 'date', 'frequency', 'interval', 'type', 'count', 'until', 'weekdays'];

    /**
     * @var array
     */
    protected $casts = ['weekdays' => 'array'];
    /**
     * @var array
     */
    protected $dates = ['date', 'until'];
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return RRule
     */
    public function getRRule()
    {
        $options = new Adapter($this->toArray());
        return new RRule($options->get());

    }
}