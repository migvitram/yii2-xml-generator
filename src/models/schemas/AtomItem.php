<?php

namespace migvitram\xmlgenerator\models\schemas;

use yii\base\Model;

class AtomItem extends Model
{
    use xmlElementWithOptionalProperties;

    /** @var string|null $title */
    public $title;

    /** @var string|null $link */
    public $link;

    public $id;

    public $updated;

    /** @var string|null $summary */
    public $summary;

    /**
     * RssItem constructor.
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