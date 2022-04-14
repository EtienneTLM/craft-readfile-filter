<?php
/**
 * Readfile plugin for Craft CMS 3.x
 *
 * Exposes readfile() to twig template filter.
 *
 * @link      https://github.com/EtienneTLM
 * @copyright Copyright (c) 2022 Etienne Bouchard
 */

namespace tlm\readfile;

use tlm\readfile\twigextensions\ReadfileTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class Readfile
 *
 * @author    Etienne Bouchard
 * @package   Readfile
 * @since     1.0.0
 *
 */
class Readfile extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Readfile
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Craft::$app->view->registerTwigExtension(new ReadfileTwigExtension());

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'readfile',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
