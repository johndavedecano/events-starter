<?php
/**
 * Created by PhpStorm.
 * User: jdecano
 * Date: 6/16/2016
 * Time: 1:43 PM
 */
namespace Jdecano\EventsStarter\Contracts;


/**
 * Class Adapter
 * @package Jdecano\EventsStarter
 */
interface AdapterInterface
{
    /**
     * @return \DateTimeZone
     */
    public function getDateTimeZoneObject();

    /**
     * @return \DateTime
     */
    public function getDtstart();

    /**
     * @return string
     */
    public function getFrequency();

    /**
     * @return int
     */
    public function getInterval();

    /**
     * @return int
     */
    public function getCount();

    /**
     * @return \DateTime
     */
    public function getUntil();

    /**
     * @return mixed
     */
    public function getByDay();

    /**
     * @return array
     */
    public function get();
}