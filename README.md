# yii2-bootstrap-duallistbox
yii2 bootstrap-duallistbox wrapper of:
https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox

For plugin options, pls. check out the site from the plugin creator

Yii2 Extension by <philipp@frenzel.net>

[![Latest Stable Version](https://poser.pugx.org/philippfrenzel/yii2fullcalendar/v/stable.svg)](https://packagist.org/packages/philippfrenzel/yii2fullcalendar)
[![Build Status](https://travis-ci.org/philippfrenzel/yii2fullcalendar.svg?branch=master)](https://travis-ci.org/philippfrenzel/yii2fullcalendar)
[![Code Climate](https://codeclimate.com/github/philippfrenzel/yii2fullcalendar.png)](https://codeclimate.com/github/philippfrenzel/yii2fullcalendar)
[![Version Eye](https://www.versioneye.com/php/philippfrenzel:yii2fullcalendar/badge.svg)](https://www.versioneye.com/php/philippfrenzel:yii2fullcalendar)
[![License](https://poser.pugx.org/philippfrenzel/yii2fullcalendar/license.svg)](https://packagist.org/packages/philippfrenzel/yii2fullcalendar)

Installation
============
Package is although registered at packagist.org - so you can just add one line of code, to let it run!

add the following line to your composer.json require section:
```json
  "philippfrenzel/yii2bsduallistbox":"*",
```

or run:
```
$ php composer.phar require philippfrenzel/yii2bsduallistbox "*"
```

And ensure, that you have the following plugin installed global:

> php composer.phar global require "fxp/composer-asset-plugin:~1.0"

Changelog
---------

04-02-2017 Initial upload

Usage
=====

Quickstart Looks like this:

```php
  <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
  ));
```

AJAX Usage
==========
If you wanna use ajax loader, this could look like this:

```php
<?= yii2fullcalendar\yii2fullcalendar::widget([
      'options' => [
        'lang' => 'de',
        //... more options to be defined here!
      ],
      'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar'])
    ]);
?>
```

and inside your referenced controller, the action should look like this:

```php
public function actionJsoncalendar($start=NULL,$end=NULL,$_=NULL){

    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $times = \app\modules\timetrack\models\Timetable::find()->where(array('category'=>\app\modules\timetrack\models\Timetable::CAT_TIMETRACK))->all();

    $events = array();

    foreach ($times AS $time){
      //Testing
      $Event = new \yii2fullcalendar\models\Event();
      $Event->id = $time->id;
      $Event->title = $time->categoryAsString;
      $Event->start = date('Y-m-d\TH:i:s\Z',strtotime($time->date_start.' '.$time->time_start));
      $Event->end = date('Y-m-d\TH:i:s\Z',strtotime($time->date_end.' '.$time->time_end));
      $events[] = $Event;
    }

    return $events;
  }
```
