<?php 

namespace Adlurfm\Fullcalendar;;


/**
 * Class that manage all FullCalendar Asset
 * @package adlurfm\yii2-fullcalendar-2
 */
class FullCalendarAsset extends \yii\web\AssetBundle {

    public $sourcePath = __DIR__.'\resources';

    public $css = [
        'css/FullCalendar.css',
    ];

    public $js = [
        //'dist\index.global.js',
        'dist/index.global.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}

