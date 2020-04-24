<?php

namespace migvitram\xmlgenerator\models\schemas;

use yii\base\Model;

class RssItem extends Model
{
    use xmlElementWithOptionalProperties;

    /** @var string|null $title */
    public $title;

    /** @var string|null $link */
    public $link;

    /** @var string|null $description */
    public $description;

    /**
     * RssItem constructor.
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