<?php

namespace migvitram\xmlgenerator\models\schemas;

use yii\base\Model;

/**
 * Class SitemapItem
 * @package migvitram\xmlgenerator\models\schemas
 */
class SitemapItem extends Model
{
    use xmlElementWithOptionalProperties;

    /**
     * SitemapItem constructor.
     * @param \stdClass $params
     */
    public function __construct( \stdClass $params )
    {
        foreach ($params as $paramName => $param) {

            if ( ! property_exists(self::class, $paramName) ) {
                $this->optionalProperties[$paramName] = $param;
            } else {
                $this->{$paramName} = $param;
            }
        }
    }

    /**
     * @param $name
     * @return bool
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