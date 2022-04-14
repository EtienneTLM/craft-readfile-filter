<?php
/**
 * Readfile Filter plugin for Craft CMS 3.x
 *
 * Exposes readfile() to twig template filter.
 *
 * @link      https://github.com/EtienneTLM
 * @copyright Copyright (c) 2022 Etienne Bouchard
 */

namespace tlm\readfilefilter;

use tlm\readfilefilter\twigextensions\ReadfileFilterTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class ReadfileFilter
 *
 * @author    Etienne Bouchard
 * @package   ReadfileFilter
 * @since     1.0.0
 *
 */
class ReadfileFilter extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ReadfileFilter
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

        Craft::$app->view->registerTwigExtension(new ReadfileFilterTwigExtension());

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
                'readfile-filter',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
