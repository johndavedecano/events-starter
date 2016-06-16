<?php

namespace Jdecano\EventsStarter;
use Jdecano\EventsStarter\Models\Event;
use Jdecano\EventsStarter\Models\EventOccurrence;
use Jdecano\EventsStarter\Models\EventSetting;
use RRule\RRule;

/**
 * Class RecurringEvent
 * @package Jdecano\EventsStarter
 */
class RecurringEvent
{
    /**
     * @param null $id
     * @param array $data
     * @return array|\StdClass
     */
    public function update($id = null, array $data)
    {
        // Update Event
        $event = Event::findOrFail($id);
        $event->update([
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        $setting = EventSetting::where('event_id', $event->id)->first();
        $setting->update([
            'date'              => $data['date'],
            'frequency'         => $data['frequency'],
            'interval'          => $data['interval'],
            'type'              => $data['type'],
            'count'             => $data['count'],
            'until'             => $data['until'],
            'weekdays'          => $data['weekdays']
        ]);

        $this->deleteOccurrences($event->id);

        $setting->save();
        $data = new \StdClass;
        $data->event = $event;
        $data->setting = $setting;
        $data->occurrences = $this->createOccurrences($event->id, $setting->toArray());

        return $data;
    }
    /**
     * @param array $data
     * @return array|\StdClass
     */
    public function create(array $data)
    {
        // Create Event
        $event = new Event([
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        $event->save();

        $setting = new EventSetting([
            'event_id'          => $event->id,
            'date'              => $data['date'],
            'frequency'         => $data['frequency'],
            'interval'          => $data['interval'],
            'type'              => $data['type'],
            'count'             => $data['count'],
            'until'             => $data['until'],
            'weekdays'          => $data['weekdays']
        ]);

        $setting->save();

        $data = new \StdClass;
        $data->event = $event;
        $data->setting = $setting;
        $data->occurrences = $this->createOccurrences($event->id, $setting->toArray());

        return $data;
    }

    /**
     * @param null $eventId
     * @param array $params
     * @return mixed
     */
    public function createOccurrences($eventId = null, array $params)
    {
        $rules = $this->getRRule($params);

        foreach ($rules as $rule) {
            $occurrence = new EventOccurrence([
                'event_id' => $eventId,
                'date' => $rule
            ]);
            $occurrence->save();
        }

        return EventOccurrence::where('event_id', $eventId)->get();
    }

    /**
     * @param array $params
     * @return RRule
     */
    public function getRRule(array $params)
    {
        $options = new Adapter($params);
        return new RRule($options->get());
    }

    /**
     * @param null $eventId
     * @return mixed
     */
    public function deleteOccurrences($eventId = null)
    {
        return EventOccurrence::where('event_id', $eventId)->delete();
    }

    /**
     * @param null $id
     * @return bool
     */
    public function destroy($id = null)
    {
        // Delete Event
        $event = Event::findOrFail($id);
        $event->delete();

        $setting = EventSetting::where('event_id', $event->id)->first();
        $setting->delete();

        $this->deleteOccurrences($event->id);

        return true;
    }

    /**
     * @param null $id
     * @return \StdClass
     */
    public function pick($id = null)
    {
        // Find Event
        $event = Event::findOrFail($id);
        $setting = EventSetting::where('event_id', $event->id)->first();
        $setting->save();
        $data = new \StdClass;
        $data->event = $event;
        $data->setting = $setting;
        $data->occurrences = EventOccurrence::where('event_id', $event->id)->get();

        return $data;
    }
}
