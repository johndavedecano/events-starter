<?php
/**
 * Created by PhpStorm.
 * User: jdecano
 * Date: 6/16/2016
 * Time: 1:28 PM
 */

namespace Jdecano\EventsStarter;
use Jdecano\EventsStarter\Contracts\AdapterInterface;

/**
 * Class Adapter
 * @package Jdecano\EventsStarter
 */
class Adapter implements AdapterInterface
{
    /**
     * @var array
     */
    private $params = array(
        'date'              => null,
        'frequency'         => 'daily',
        'interval'          => 1,
        'type'              => 'by_date',
        'count'             => 1,
        'until'             => null,
        'weekdays'          => []
    );

    /**
     * ReqRule constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = array_merge($this->params, $params);
    }

    /**
     * @return \DateTimeZone
     */
    public function getDateTimeZoneObject()
    {
        return new \DateTimeZone(config('app.timezone'));
    }

    /**
     * @return bool|string
     */
    private function getOccurrencesDate()
    {
        if (is_null($this->params['until'])) {
            return date("Y-m-d", strtotime("+1 day"));
        }

        return $this->params['until'];
    }

    /**
     * @return bool|string
     */
    private function getDate()
    {
        if (is_null($this->params['date'])) {
            return date("Y-m-d", strtotime("+1 day"));
        }

        return $this->params['date'];
    }

    /**
     * @return \DateTime
     */
    public function getDtstart()
    {
        return new \DateTime(
            $this->getDate(),
            $this->getDateTimeZoneObject()
        );
    }

    /**
     * @return string
     */
    public function getFrequency()
    {
        return strtoupper($this->params['frequency']);
    }

    /**
     * @return int
     */
    public function getInterval()
    {
        $interval = intval($this->params['interval']);
        return ($interval == 0) ? 1 : $interval;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        $count = intval($this->params['count']);
        return ($count == 0) ? 1 : $count;
    }

    /**
     * @return \DateTime
     */
    public function getUntil()
    {
        return new \DateTime(
            $this->getOccurrencesDate(),
            $this->getDateTimeZoneObject()
        );
    }

    /**
     * @return mixed
     */
    public function getByDay()
    {
        return $this->params['weekdays'];
    }

    /**
     * @return array
     */
    public function get()
    {
        $rules = [
            'DTSTART'   => $this->getDtstart(),
            'INTERVAL'  => $this->getInterval(),
            'FREQ'      => $this->getFrequency(),
        ];

        if ($this->params['type'] == 'by_date') {
            $rules['UNTIL'] = $this->getUntil();
        }

        if ($this->params['type'] == 'by_count') {
            $rules['COUNT'] = $this->getCount();
        }

        if ($this->params['frequency'] == 'weekly') {
            $rules['BYDAY'] = $this->getByDay();
        }

        return $rules;
    }
}