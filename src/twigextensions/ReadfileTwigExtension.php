<?php
/**
 * Readfile plugin for Craft CMS 3.x
 *
 * Exposes readfile() to twig template filter.
 *
 * @link      https://github.com/EtienneTLM
 * @copyright Copyright (c) 2022 Etienne Bouchard
 */

namespace tlm\readfile\twigextensions;

use tlm\readfile\Readfile;

use Craft;
use craft\helpers\FileHelper;
use Twig\TwigFilter;

/**
 * @author    Etienne Bouchard
 * @package   Readfile
 * @since     1.0.0
 */
class ReadfileTwigExtension extends \Twig_Extension
{
    // Protected Properties
    // =========================================================================

    /**
    * @var    bool|array Allows anonymous access to this controller's actions.
    *         The actions must be in 'kebab-case'
    * @access protected
    */
    protected $allowAnonymous = ['fetch'];

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Readfile';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('readfile', [$this, 'readFileFilter']),
        ];
    }

    /**
     * @param null $filename
     *
     * @return 
     */
    public function readFileFilter($file)
    {
        // stop content-type from being overridden
        // https://github.com/craftcms/cms/issues/4716
        Craft::$app->response->format = \yii\web\Response::FORMAT_RAW;

        // generate the filesystem path to the file
        $filepath = FileHelper::normalizePath($file);

        // get only the filename
        $filename = basename($file);

        // get the files mime type
        $mimeType = FileHelper::getMimeTypeByExtension($filename);

        // use an optimized header for pdfs
        if ($mimeType == "application/pdf") {
            
            Craft::$app->response->headers
                ->set('Content-Type', 'application/pdf; charset=UTF-8')
                ->set('Content-Disposition', 'inline; filename="' . $filename . '"')
                ->set('Content-Transfer-Encoding', 'binary')
                ->set('Accept-Ranges', 'bytes');
        }
        else {
            
            Craft::$app->response->headers
                ->set('Content-Type', $mimeType . '; charset=UTF-8');
        }

        // render the file content directly to the output
        readfile($filepath);
    }
}