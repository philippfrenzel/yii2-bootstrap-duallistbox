# yii2-bootstrap-duallistbox
yii2 bootstrap-duallistbox wrapper of:
https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox

For plugin options, pls. check out the site from the plugin creator

Yii2 Extension by <philipp@frenzel.net>

[![Latest Stable Version](https://poser.pugx.org/philippfrenzel/yii2bsduallistbox/v/stable.svg)](https://packagist.org/packages/philippfrenzel/yii2bsduallistbox)
[![Build Status](https://travis-ci.org/philippfrenzel/yii2-bootstrap-duallistbox.svg?branch=master)](https://travis-ci.org/philippfrenzel/yii2-bootstrap-duallistbox)
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

use net\frenzel\yii2bsduallistbox\yii2bsduallistbox;
...
<?php
    
    $options = [
        'multiple' => true,
        'size' => 20,
    ];

    // echo Html::listBox($name, $selection, $items, $options);
    echo yii2bsduallistbox::widget([
        'name' => $name,
        'selection' => $selection,
        'items' => $items,
        'options' => $options,
        'clientOptions' => [
            'moveOnSelect' => false,
            'selectedListLabel' => 'Selected Items',
            'nonSelectedListLabel' => 'Available Items',
        ],
    ]);
?>

```

