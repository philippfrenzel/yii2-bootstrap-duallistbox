<?php

namespace net\frenzel\yii2bsduallistbox\tests\unit;

use \net\frenzel\yii2bsduallistbox\yii2bsduallistbox;

/**
 * This is MasonryTest unit test.
 *
 * @see       yii2masonry\yii2masonry
 * @license   https://github.com/philippfrenzel/yii2masonry/blob/master/LICENSE.md MIT
 *
 * @author    Philipp Frenzel <philipp@frenzel.net>
 */

class FullcalendarTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \yii2masonry\yii2masonry
     */
    protected $instance;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->instance = new yii2bsduallistbox();
    }

    /**
     * @inheritdoc
     */
    protected function _after()
    {
        $this->instance = null;
    }

    // tests
    public function testMe()
    {

    }

}