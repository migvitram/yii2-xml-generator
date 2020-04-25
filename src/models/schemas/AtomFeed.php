<?php

namespace migvitram\xmlgenerator\models\schemas;

use yii\base\Model;

/**
 * Class AtomFeed
 * @package migvitram\xmlgenerator\models\schemas
 */
class AtomFeed extends Model
{
    use xmlElementWithOptionalProperties;

    /** @var   */
    public $title, $link, $updated, $id;

    /** @var array|bool $items */
    public $items = [];

    /**
     * AtomFeed constructor.
     * @param \stdClass $params
     */
    public function __construct( \stdClass $params )
    {
        foreach ($params as $paramName => $param) {

            if ( ! property_exists(self::class, $paramName) ) {
                $this->optionalProperties[$paramName] = $param;
            } elseif ( $paramName != 'items' ) {
                $this->{$paramName} = $param;
            }
        }

        if ( $items = $params->items ?? false ) {
            $this->items = $items;

            array_walk($this->items, function(&$value, $key){
                //$value = (object)$value;
                $value = new AtomItem( (object)$value );
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