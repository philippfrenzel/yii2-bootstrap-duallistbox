# yii2-bootstrap-duallistbox
yii2 bootstrap-duallistbox wrapper of:
https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox

For plugin options, pls. check out the site from the plugin creator

Yii2 Extension by <philipp@frenzel.net>

[![Latest Stable Version](https://poser.pugx.org/philippfrenzel/yii2bsduallistbox/v/stable.svg)](https://packagist.org/packages/philippfrenzel/yii2bsduallistbox)
[![Build Status](https://travis-ci.org/philippfrenzel/yii2bsduallistbox.svg?branch=master)](https://travis-ci.org/philippfrenzel/yii2bsduallistbox)
[![Code Climate](https://codeclimate.com/github/philippfrenzel/yii2-bootstrap-duallistbox.png)](https://codeclimate.com/github/philippfrenzel/yii2-bootstrap-duallistbox)
[![Version Eye](https://www.versioneye.com/php/philippfrenzel:yii2bsduallistbox/badge.svg)](https://www.versioneye.com/php/philippfrenzel:yii2bsduallistbox)
[![License](https://poser.pugx.org/philippfrenzel/yii2bsduallistbox/license.svg)](https://packagist.org/packages/philippfrenzel/yii2bsduallistbox)

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
  <?= \yii2bsduallistbox\yii2bsduallistbox::widget([
      'events'=> $events,
  ]);
```

AJAX Usage
==========
If you wanna use ajax loader, this could look like this:

```php
<?= yii2bsduallistbox\yii2bsduallistbox::widget([
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
