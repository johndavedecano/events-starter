# Laravel 5 Events Starter
Easily start up your recurring events application.

## Install

```
composer require jdecano/events-starter
# Register Provider
Jdecano\EventsStarter\EventsStarterServiceProvider::class,
# Register Facade
'RecurringEvent' => Jdecano\EventsStarter\Facades\RecurringEvent::class
# Migrate
php artisan migrate --path=vendor/jdecano/events-starter/database/migrations
```

## Basic Usage

1. title - Title of the event
2. description - Description of the event
3. date - A php date to when the event will take place
4. frequency - yearly, monthly, weekly, daily
5. interval - The interval between each FREQUENCY iteration. For example, when using YEARLY, an interval of 2 means once every two years, but with HOURLY, it means once every two hours. Default is 1.
6. type - by_date or by_count. If you use by_date generation of occurrences will be based on until. If you use by_count generation of occurrences will be on count.
7. count - How many occurrences will be generated.
8. until - The limit of the recurrence. Accepts the same formats as DTSTART. If a recurrence instance happens to be the same the date given, this will be the last occurrence
9. weekdays -The day(s) of the week to apply the recurrence to from MO (Monday) to SU (Sunday). Must be one of the following strings: MO, TU, WE, TH, FR, SA, SU. It can be a single value, or a comma-separated list or an array
```
$event = RecurringEvent::create([
	'title'             => 'My Event Title',
	'description'       => 'My Event Description',
	'date'              => date("Y-m-d"),
	'frequency'         => 'daily',
	'interval'          => 1,
	'type'              => 'by_date', // or by_count
	'count'             => 1,
	'until'             => date("Y-m-d"), // Requires PHP date
	'weekdays'          => ["SU", "MO", "TU", "WE"]
]);

$event = RecurringEvent::update($eventId, [
	'title'             => 'My Event Title',
	'description'       => 'My Event Description',
	'date'              => date("Y-m-d"),
	'frequency'         => 'daily',
	'interval'          => 1,
	'type'              => 'by_date', // or by_count
	'count'             => 1,
	'until'             => date("Y-m-d"), // Requires PHP date
	'weekdays'          => ["SU", "MO", "TU", "WE"]
]);


$event = RecurringEvent::pick($eventId);

$event = RecurringEvent::destroy($eventId);

# Getting RRule Object

$setting = EventSetting::where('event_id', $event_id)->first();

$rrule = $setting->getRRule();

foreach ( $rrule as $occurrence ) {
    echo $occurrence->format('r'),"\n";
}

// output:
// Tue, 02 Sep 1997 09:00:00 +0000
// Thu, 04 Sep 1997 09:00:00 +0000
// Sat, 06 Sep 1997 09:00:00 +0000
// Mon, 08 Sep 1997 09:00:00 +0000
// Wed, 10 Sep 1997 09:00:00 +0000


$rrule->humanReadable();

// every other week on Monday, Wednesday and Friday, starting from 9/1/97, until 12/23/97
// Refer to https://github.com/rlanvin/php-rrule/wiki/RRule
```


If you discover any security related issues, please email johndavedecano@gmail.com instead of using the issue tracker.

## Credits
- John Dave Decano http://johndavedecano.me

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.