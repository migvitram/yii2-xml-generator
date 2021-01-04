<?php

namespace migvitram\xmlgenerator\models\schemas\Sitemap;

use yii\base\Model;

/**
 * Class SitemapXml
 * @package migvitram\xmlgenerator\models\schemas
 */
class SitemapXml extends Model
{
    /** @var array|bool $items */
    public $items = [];

    /**
     * SitemapXml constructor.
     * @param \stdClass $items
     */
    public function __construct( \stdClass $items )
    {
        if ( !empty($items) ) {
            $this->items = $items;

            array_walk($this->items, function(&$value, $key){

                $value = new SitemapItem( (object)$value );
            });
        }
    }
}