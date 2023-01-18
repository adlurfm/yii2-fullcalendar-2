# Yii2-Fullcalendar-2
FullCalendar.io component for Yii2

## Installation
```sh
$ php composer.phar require adlurfm/yii2-fullcalendar-2
```
or add 
```sh
"adlurfm/yii2-fullcalendar-2": "dev-main"
```
to the `require` section of your `composer.json` file.

## Usage
```php
<?= FullCalendar::widget([
        'options'       => [
            'id'       => 'calendar',
            'initialDate' => date('Y-m-d'),
            'timeZone'=>'Asia/Kuala_lumpur'
        ],
        'clientOptions' => [
            'weekNumbers' => true,
            'selectable'  => true,
            'initialView' => 'timeGridWeek',
            'events' =>Url::to(['site/events']),
            'eventTimeFormat'=> [ // like '14:30'
                'hour'=>'2-digit',
                'minute'=>'2-digit',
                'meridiem' => false,
                'hour12'=> false
            ]
        ],
    ]); ?>
```

Read more options at - [fullcalendar.io](https://fullcalendar.io/docs)

