<?php

namespace migvitram\xmlgenerator\models\schemas;

use yii\base\Model;

/**
 * Class RssChannel
 * @package migvitram\xmlgenerator\models\schemas
 */
class RssChannel extends Model
{
    use xmlElementWithOptionalProperties;

    /**
     * Required Rss channel properties
     */

    /** @var bool $title */
    public $title;

    /** @var bool $link */
    public $link;

    /** @var bool $description */
    public $description;

    /** @var object|null $image  -  image of the rss channel */
    public $image;

    /** @var array $items */
    public $items = [];

    /**
     * RssChannel constructor.
     * @param \stdClass $params
     */
    public function __construct( \stdClass $params )
    {
        foreach ($params as $paramName => $param) {

            if ( ! property_exists(self::class, $paramName) ) {
                $this->optionalProperties[$paramName] = $param;
            } elseif ( $paramName != 'items' && $paramName != 'image') {
                $this->{$paramName} = $param;
            }
        }

        if ( $rssImage = $params->image ?? false ) {

            $rssImage = (object)$rssImage;

            $this->image = (object)[
                'url'   => $rssImage->url ?? false,
                'title' => $rssImage->title ?? false,
                'link'  => $rssImage->link ?? false,
            ];

            if ( !$this->image->url || !$this->image->title || !$this->image->link ) {
                $this->image = false;
            }
        }

        if ( $items = $params->items ?? false ) {
            $this->items = $items;

            array_walk($this->items, function(&$value, $key){
                //$value = (object)$value;
                $value = new RssItem( (object)$value );
            });
        }
    }

    /**
     * @param $name
     * @return bool|mixed
     */
    public function __get($name)
    {
        if ( property_exists(self::class, $name) ) {
            return $this->{$name} ?? false;
        }else{
            return $this->optionalProperties[$name] ?? false;
        }
    }
}