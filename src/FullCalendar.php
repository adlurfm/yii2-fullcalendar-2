<?php 

namespace Adlurfm\Fullcalendar;

/**
 * Class that represents FullCalendar Widget
 * @package adlurfm\yii2-fullcalendar-2
 */
class FullCalendar extends \yii\base\Widget{

    //Default options
    public $options = [
		'id'    => 'calendar',
		'class' => 'fullcalendar',
	];

    //Default values for widget
    public $clientOptions = [
		'weekends' => true,
		'default'  => 'agendaDay',
		'editable' => false,
	];

    //store the event for later
    public $events = [];

    public $headerToolbar = [
		'center' => 'title',
		'left'   => 'prev,next,today',
		'right'  => 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
	];
    //TODO list all the toolbars buttons


    /**
	 * Always make sure we have a valid id and class for the Fullcalendar widget
	 */
	public function init()
	{
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
		if (!isset($this->options['class'])) {
			$this->options['class'] = 'fullcalendar';
		}

		//parent::init();
	}


    /**
	 * Run the widget
	 */
	public function run()
	{
		$fullcalendar_asset = FullCalendarAsset::register($this->view);

		$this->clientOptions['headerToolbar'] = $this->headerToolbar;

        //{$this->options['id']}
        //{$this->getClientOptions()}

        $js_script = <<< JS
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('{$this->options['id']}');
    var calendar = new FullCalendar.Calendar(calendarEl, {$this->getClientOptions()});
    calendar.render();
});
JS;
        $this->view->registerJs($js_script, \yii\web\View::POS_END);
        echo "<div id='{$this->options['id']}'></div>";
	}

    /**
	 * @return string
	 * Returns an JSON array containing the fullcalendar options,
	 */
	private function getClientOptions()
	{
		$options['events'] = $this->events;
		$options = array_merge($options, $this->clientOptions);

		return \yii\helpers\Json::encode($options, $asArray = true);
	}
}