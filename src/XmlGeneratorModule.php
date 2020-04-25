<?php

namespace migvitram\xmlgenerator;

use migvitram\xmlgenerator\models\schemas\AtomSchema;
use migvitram\xmlgenerator\models\schemas\RssChannel;
use migvitram\xmlgenerator\models\schemas\RssSchema;
use yii\base\Module as BaseModule;

/**
 * Class XmlGeneratorModule
 * @package migvitram\xmlgenerator
 */
class XmlGeneratorModule extends BaseModule
{
    const VERSION = '0.1.3';

    /** @var array  $pages  -  callback to retrieve pages for sitemap.xml */
    public $pages;

    /** @var array  $pagesArray = result array of urls for sitemap.xml */
    public $pagesArray = [];

    /** @var array $atom - callback to retrieve pages for atom.xml */
    public $atom;

    /** @var array $atomInstance - result array of urls for atom.xml */
    public $atomInstance;

    /** @var array $rss  -  callback to retrieve pages for rss.xml */
    public $rss;

    /** @var RssChannel|null $rssInstance - result object for rss.xml */
    public $rssInstance;

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        [
            'pattern' => 'sitemap',
            'route' => 'main/index',
            'suffix' => '.xml',
        ],
        [
            'pattern' => 'atom',
            'route' => 'main/atom',
            'suffix' => '.xml',
        ],
        [
            'pattern' => 'rss',
            'route' => 'main/rss',
            'suffix' => '.xml',
        ],
    ];

    /** @var array Model map */
    public $modelMap = [];

    /**
     * Initiation method for Module
     */
    public function init()
    {
        // pages for sitemap.xml
        if ( is_callable($this->pages) ) {
            $this->pagesArray = call_user_func($this->pages);

            array_walk($this->pagesArray, function( &$value, $key ){
                $value = (object)$value;
            });
        }

        // items for atom.xml
        if ( is_callable($this->atom) ) {

            $params = call_user_func($this->atom);
            $this->atomInstance = AtomSchema::initiateFeed($params);
        }

        // items for rss.xml
        if ( is_callable($this->rss) ) {

            $params = call_user_func($this->rss);
            $this->rssInstance = RssSchema::initiateChannel( $params );
        }

        parent::init();
    }

}