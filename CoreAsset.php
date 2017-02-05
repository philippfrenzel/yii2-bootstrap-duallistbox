<?php

namespace namespace net\frenzel\yii2bsduallistbox;

use Yii;
use yii\web\AssetBundle;

/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

class CoreAsset extends AssetBundle
{
    /**
     * [$sourcePath description]
     * @var string
     */
    public $sourcePath = '@bower/bootstrap-duallistbox/dist';

    /**
     * the language the calender will be displayed in
     * @var string ISO2 code for the wished display language
     */
    public $language = NULL;

    /**
     * [$autoGenerate description]
     * @var boolean
     */
    public $autoGenerate = true;

    /**
     * [$css description]
     * @var array
     */
    public $css = [
        'bootstrap-duallistbox.css',
    ];

    /**
     * [$js description]
     * @var array
     */
    public $js = [
        'jquery.bootstrap-duallistbox.js',
    ];
    
    /**
     * [$depends description]
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset'
    ];

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        /*
        $language = $this->language ? $this->language : Yii::$app->language;
        if ($language != 'en-us') 
        {
            $this->js[] = "lang/{$language}.js";
        }*/

        parent::registerAssetFiles($view);
    }

}
