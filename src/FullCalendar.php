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
		'left'   => 'prev,next, today',
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

		/* if ($this->theme === true) { // Register the theme
			ThemeAsset::register($this->view);
		} 

		if (isset($this->options['language'])) {
			$assets->language = $this->options['language'];
		}

		$assets->googleCalendar = $this->googleCalendar;
        */

		$this->clientOptions['headerToolbar'] = $this->headerToolbar;

        //{$this->options['id']}
        //{$this->getClientOptions()}

        $js_script = <<< JS
        
document.addEventListener('DOMContentLoaded', function() {

    /* initialize the external events
    -----------------------------------------------------------------*/

    var containerEl = document.getElementById('external-events-list');
    new FullCalendar.Draggable(containerEl, {
    itemSelector: '.fc-event',
    eventData: function(eventEl) {
        return {
        title: eventEl.innerText.trim()
        }
    }
    });

    //// the individual way to do it
    // var containerEl = document.getElementById('external-events-list');
    // var eventEls = Array.prototype.slice.call(
    //   containerEl.querySelectorAll('.fc-event')
    // );
    // eventEls.forEach(function(eventEl) {
    //   new FullCalendar.Draggable(eventEl, {
    //     eventData: {
    //       title: eventEl.innerText.trim(),
    //     }
    //   });
    // });

    /* initialize the calendar
    -----------------------------------------------------------------*/

    var calendarEl = document.getElementById('{$this->options['id']}');
    var calendar = new FullCalendar.Calendar(calendarEl, {$this->getClientOptions()});
    calendar.render();
});
JS;

/* TODO
{
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
  },
  editable: true,
  droppable: true, // this allows things to be dropped onto the calendar
  drop: function(arg) {
    // is the "remove after drop" checkbox checked?
    if (document.getElementById('drop-remove').checked) {
      // if so, remove the element from the "Draggable Events" list
      arg.draggedEl.parentNode.removeChild(arg.draggedEl);
    }
  }
}
*/
		$this->view->registerJs(implode("\n", [$js_script,
		]), \yii\web\View::POS_END);
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