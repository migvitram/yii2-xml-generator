<?php

namespace migvitram\xmlgenerator;

use migvitram\xmlgenerator\models\schemas\AtomSchema;
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

    /** @var array $atomArray - result array of urls for atom.xml */
    public $atomArray = [];

    /** @var array $rss  -  callback to retrieve pages for rss.xml */
    public $rss;

    /** @var array $rssArray - result array of urls for rss.xml */
    public $rssArray = [];

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
            $this->atomArray = call_user_func($this->atom);

            array_walk($this->atomArray, function( &$value, $key ){

                $value = (object)$value;

                if ($key == 'items') {

                    // for the 'main' and 'items' section of array
                    array_walk($value, function( &$innerVal, $innerKey){
                        $innerVal = (object)$innerVal;
                    });
                }
            });
        }

        // if empty need default main section
        if ( empty($this->atomArray) ) {
            $this->atomArray = ['main' => (object)AtomSchema::getDefaultMainParams()];
        }

        // items for rss.xml
        if ( is_callable($this->rss) ) {
            $this->rssArray = call_user_func($this->rss);

            array_walk($this->rssArray, function( &$value, $key ){
                $value = (object)$value;
            });
        }

        parent::init();
    }

}