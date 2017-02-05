<?php

 /**
 * This class is used to embed FullCalendar JQuery Plugin to my Yii2 Projects
 * @copyright Frenzel GmbH - www.frenzel.net
 * @link http://www.frenzel.net
 * @author Philipp Frenzel <philipp@frenzel.net>
 *
 */

namespace yii2bsduallistbox;

use Yii;
use yii\base\Model;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\base\Widget as elWidget;

class yii2bsduallistbox extends elWidget
{

    /**
    * @var array options the HTML attributes (name-value pairs) for the field container tag.
    * The values will be HTML-encoded using [[Html::encode()]].
    * If a value is null, the corresponding attribute will not be rendered.
    */
    public $options = [
        'class' => 'yii2bsduallistbox',
        'theme' => true,
    ];

    /**
     * @var array clientOptions the HTML attributes for the widget container tag.
     */
    public $clientOptions = [
        'weekends' => true,
        'default' => 'month',
        'editable' => false,
    ];

    /**
    * Holds an array of Event Objects
    * @var array events of yii2fullcalendar\models\Event
    * @todo add the event class and write docs
    **/
    public $events = [];

    /**
     * Define the look n feel for the calendar header, known placeholders are left, center, right
     * @var array header format
     */
    public $header = [
        'center'=>'title',
        'left'=>'prev,next today',        
        'right'=>'month,agendaWeek'
    ];

    /**
     * Will hold an url to json formatted events!
     * @var url to json service
     */
    public $ajaxEvents = NULL;
    
    /**
     * wheather the events will be "sticky" on pagination or not
     * @var boolean
     */
    public $stickyEvents = true;

    /**
     * tell the calendar, if you like to render google calendar events within the view
     * @var boolean
     */
    public $googleCalendar = false;

    /**
     * the text that will be displayed on changing the pages
     * @var string
     */
    public $loading = 'Loading ...';

    /**
     * internal marker for the name of the plugin
     * @var string
     */
    private $_pluginName = 'yii2bsduallistbox';

    /**
     * The javascript function to us as en eventRender callback
     * @var string the javascript code that implements the eventRender function
     */
    public $eventRender = "";

    /**
     * The javascript function to us as en eventAfterRender callback
     * @var string the javascript code that implements the eventAfterRender function
     */
    public $eventAfterRender = "";

    /**
     * The javascript function to us as en eventAfterAllRender callback
     * @var string the javascript code that implements the eventAfterAllRender function
     */
    public $eventAfterAllRender = "";

    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        //checks for the element id
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        //checks for the class
        if (!isset($this->options['class'])) {
            $this->options['class'] = 'fullcalendar';
        }
        //checks for the theme
        if (!isset($this->options['theme'])) {
            $this->options['theme'] = true;
        }

        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {   
        $this->options['data-plugin-name'] = $this->_pluginName;

        if (!isset($this->options['class'])) {
            $this->options['class'] = 'fullcalendar';
        }
        
        echo Html::beginTag('div', $this->options) . "\n";
            echo Html::beginTag('div',['class'=>'fc-loading','style' => 'display:none;']);
                echo Html::encode($this->loading);
            echo Html::endTag('div')."\n";
        echo Html::endTag('div')."\n";
        $this->registerPlugin();
    }

    /**
    * Registers the FullCalendar javascript assets and builds the requiered js  for the widget and the related events
    */
    protected function registerPlugin()
    {        
        $id = $this->options['id'];
        $view = $this->getView();

        /** @var \yii\web\AssetBundle $assetClass */
        $assets = CoreAsset::register($view);

        //by default we load the jui theme, but if you like you can set the theme to false and nothing gets loaded....
        if($this->options['theme'] == true)
        {
            ThemeAsset::register($view);
        }

        if (isset($this->options['lang'])) 
        {
            $assets->language = $this->options['lang'];
        }        
        
        if ($this->googleCalendar) 
        {
            $assets->googleCalendar = $this->googleCalendar;
        }

        $js = array();

        if($this->ajaxEvents != NULL){
            $this->clientOptions['events'] = $this->ajaxEvents;
        }

        if(is_array($this->header) && isset($this->clientOptions['header']))
        {
            $this->clientOptions['header'] = array_merge($this->header,$this->clientOptions['header']);
        } else {
            $this->clientOptions['header'] = $this->header;
        }

        $cleanOptions = $this->getClientOptions();
        $js[] = "jQuery('#$id').fullCalendar($cleanOptions);";

        //lets check if we have an event for the calendar...
        if(count($this->events)>0)
        {
            foreach($this->events AS $event)
            {
                $jsonEvent = Json::encode($event);
                $isSticky = $this->stickyEvents;
                $js[] = "jQuery('#$id').fullCalendar('renderEvent',$jsonEvent,$isSticky);";
            }
        }
        
        $view->registerJs(implode("\n", $js),View::POS_READY);
    }

    /**
     * @return array the options for the text field
     */
    protected function getClientOptions()
    {
        $id = $this->options['id'];
        $options['loading'] = new JsExpression("function(isLoading, view ) {
                jQuery('#{$id}').find('.fc-loading').toggle(isLoading);
        }");
        if ($this->eventRender){
            $options['eventRender'] = new JsExpression($this->eventRender);
        }
        if ($this->eventAfterRender){
            $options['eventAfterRender'] = new JsExpression($this->eventAfterRender);
        }
        if ($this->eventAfterAllRender){
            $options['eventAfterAllRender'] = new JsExpression($this->eventAfterAllRender);
        }
        $options = array_merge($options, $this->clientOptions);
        return Json::encode($options);
    }

}
